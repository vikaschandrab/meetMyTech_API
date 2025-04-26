<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserService
{
    /**
     * Validate user update request.
     *
     * @param array $data
     * @param int|null $userId
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateUserUpdate(array $data, ?int $userId = null)
    {
        return Validator::make($data, [
            'email' => 'nullable|email|unique:users,email,' . $userId,
            'name' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'contact_number' => 'nullable|string|max:20',
        ]);
    }

    /**
     * Update user fields.
     *
     * @param \App\Models\User $user
     * @param array $data
     * @return \App\Models\User
     */
    public function updateUser($user, array $data)
    {
        if (isset($data['email'])) {
            $user->email = $data['email'];
        }

        if (isset($data['name'])) {
            $user->name = $data['name'];
        }

        if (isset($data['profile_picture']) && $data['profile_picture'] instanceof UploadedFile) {
            // Delete old profile picture if it exists
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Create a unique file name with the user's name
            $fileName = $user->name . '_' . time() . '.' . $data['profile_picture']->getClientOriginalExtension();

            // Store the new profile picture
            $path = $data['profile_picture']->storeAs('profile_pictures', $fileName, 'public');

            // Update the user's profile picture path
            $user->profile_picture = $path;
        }

        if (isset($data['contact_number'])) {
            $user->contact_number = $data['contact_number'];
        }

        $user->save();

        return $user;
    }
}
