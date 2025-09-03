<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Exception;

class ProfileService
{
    /**
     * Get user profile data
     *
     * @return array
     */
    public function getProfileData(): array
    {
        /** @var User $user */
        $user = Auth::user();
        $details = $user->detail;

        return [
            'user' => $user,
            'details' => $details
        ];
    }

    /**
     * Update user profile
     *
     * @param array $data
     * @return bool
     * @throws Exception
     */
    public function updateProfile(array $data): bool
    {
        try {
            /** @var User $user */
            $user = Auth::user();

            // Debug logging for cropped image
            if (app()->environment('local')) {
                Log::info('ProfileService updateProfile called', [
                    'has_cropped_image' => isset($data['cropped_image']),
                    'cropped_image_length' => isset($data['cropped_image']) ? strlen($data['cropped_image']) : 0,
                    'has_profile_pic' => isset($data['profile_pic']),
                    'data_keys' => array_keys($data)
                ]);
            }

            // Handle cropped image data
            if (isset($data['cropped_image']) && $data['cropped_image']) {
                Log::info('Processing cropped image', ['user_id' => $user->id]);
                $profilePicPath = $this->handleCroppedImageUpload($data['cropped_image'], $user);
                $user->profilePic = $profilePicPath;
                $user->save();
                Log::info('Cropped image saved', ['path' => $profilePicPath]);
            }
            // Handle profile image upload (simplified version without GD) - fallback
            elseif (isset($data['profile_pic']) && $data['profile_pic']) {
                $profilePicPath = $this->handleSimpleProfilePictureUpload($data['profile_pic'], $user);
                $user->profilePic = $profilePicPath;
                $user->save();
            }

            // Update basic user info
            $user->fill([
                'name' => $data['name'],
                'email' => $data['email'],
                'contactNum' => $data['contactNum']
            ]);
            $user->save();

            // Update or create user details
            $this->updateUserDetails($user, $data);

            return true;
        } catch (Exception $e) {
            throw new Exception('Failed to update profile: ' . $e->getMessage());
        }
    }

    /**
     * Simple profile picture upload without image processing
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param User $user
     * @return string
     */
    private function handleSimpleProfilePictureUpload($file, User $user): string
    {
        // Delete old profile picture if exists
        if ($user->profilePic && Storage::disk('public')->exists($user->profilePic)) {
            Storage::disk('public')->delete($user->profilePic);
        }

        // Generate unique filename
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Store file directly without image processing
        $path = $file->storeAs('profile_pics', $filename, 'public');

        return $path;
    }

    /**
     * Handle profile picture upload
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param User $user
     * @return string
     */
    private function handleProfilePictureUpload($file, User $user): string
    {
        // Delete old profile picture if exists
        if ($user->profilePic && Storage::disk('public')->exists($user->profilePic)) {
            Storage::disk('public')->delete($user->profilePic);
        }

        // Generate unique filename
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $user->name . '/profile_pics/' . $filename;

        // Check if GD extension is available for image processing
        if (extension_loaded('gd')) {
            try {
                // Resize and optimize image using Intervention Image
                $image = Image::make($file->getRealPath());
                $image->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                // Save the processed image
                Storage::disk('public')->put($path, (string) $image->encode());
            } catch (Exception $e) {
                // Fallback to direct upload if image processing fails
                $path = $file->storeAs('profile_pics', $filename, 'public');
            }
        } else {
            // Direct upload without image processing if GD is not available
            $path = $file->storeAs('profile_pics', $filename, 'public');
        }

        return $path;
    }

    /**
     * Handle cropped image upload from base64 data
     *
     * @param string $base64Data
     * @param User $user
     * @return string
     * @throws Exception
     */
    private function handleCroppedImageUpload(string $base64Data, User $user): string
    {
        try {
            Log::info('handleCroppedImageUpload called', [
                'user_id' => $user->id,
                'data_length' => strlen($base64Data)
            ]);

            // Delete old profile picture if exists
            if ($user->profilePic && Storage::disk('public')->exists($user->profilePic)) {
                Storage::disk('public')->delete($user->profilePic);
                Log::info('Deleted old profile picture', ['path' => $user->profilePic]);
            }

            // Extract base64 data (remove data:image/jpeg;base64, prefix)
            if (preg_match('/^data:image\/(\w+);base64,/', $base64Data, $type)) {
                $data = substr($base64Data, strpos($base64Data, ',') + 1);
                $type = strtolower($type[1]); // jpg, png, gif

                Log::info('Extracted image type', ['type' => $type]);

                if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                    throw new Exception('Invalid image type: ' . $type);
                }
            } else {
                throw new Exception('Invalid base64 image data format');
            }

            // Decode base64 data
            $imageData = base64_decode($data);

            if ($imageData === false) {
                throw new Exception('Failed to decode base64 image data');
            }

            Log::info('Decoded image data', ['size' => strlen($imageData)]);

            // Generate unique filename
            $filename = time() . '_' . uniqid() . '.' . ($type === 'jpg' ? 'jpeg' : $type);
            $path = 'profile_pics/' . $filename;

            // Store the image
            $success = Storage::disk('public')->put($path, $imageData);

            if (!$success) {
                throw new Exception('Failed to store image file');
            }

            Log::info('Image stored successfully', ['path' => $path]);

            return $path;

        } catch (Exception $e) {
            Log::error('Failed to process cropped image', [
                'error' => $e->getMessage(),
                'user_id' => $user->id
            ]);
            throw new Exception('Failed to process cropped image: ' . $e->getMessage());
        }
    }

    /**
     * Update user details
     *
     * @param User $user
     * @param array $data
     * @return void
     */
    private function updateUserDetails(User $user, array $data): void
    {
        $details = $user->detail()->firstOrCreate([]);

        $details->update([
            'github_profile' => $data['github'] ?? null,
            'twitter_profile' => $data['twitter'] ?? null,
            'facebook_profile' => $data['facebook'] ?? null,
            'instagram_profile' => $data['instagram'] ?? null,
            'linkedin_profile' => $data['linkedin'] ?? null,
            'whatsapp_number' => $data['contactNum'],
            'address' => $data['address'],
        ]);
    }

    /**
     * Get social media profiles for display
     *
     * @param $details
     * @return array
     */
    public function getSocialMediaProfiles($details): array
    {
        $socialProfiles = [];

        $platforms = [
            'github_profile' => ['icon' => 'github', 'name' => 'GitHub'],
            'twitter_profile' => ['icon' => 'twitter', 'name' => 'Twitter'],
            'facebook_profile' => ['icon' => 'facebook', 'name' => 'Facebook'],
            'instagram_profile' => ['icon' => 'instagram', 'name' => 'Instagram'],
            'linkedin_profile' => ['icon' => 'linkedin', 'name' => 'LinkedIn'],
        ];

        foreach ($platforms as $key => $platform) {
            if (!empty($details->$key)) {
                $socialProfiles[] = [
                    'url' => $details->$key,
                    'icon' => $platform['icon'],
                    'name' => $platform['name']
                ];
            }
        }

        return $socialProfiles;
    }
}
