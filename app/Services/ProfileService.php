<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
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

            // Handle profile image upload (simplified version without GD)
            if (isset($data['profile_pic']) && $data['profile_pic']) {
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
