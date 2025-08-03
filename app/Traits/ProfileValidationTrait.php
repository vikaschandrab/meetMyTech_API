<?php

namespace App\Traits;

trait ProfileValidationTrait
{
    /**
     * Get validation rules for profile update
     *
     * @return array
     */
    public function getProfileValidationRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'contactNum' => 'required|string|max:15',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required|string|max:500',
            'github' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
        ];
    }

    /**
     * Get validation messages for profile update
     *
     * @return array
     */
    public function getProfileValidationMessages(): array
    {
        return [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.unique' => 'This email is already taken.',
            'contactNum.required' => 'Contact number is required.',
            'profile_pic.image' => 'Profile picture must be an image.',
            'profile_pic.mimes' => 'Profile picture must be a file of type: jpeg, png, jpg, gif.',
            'profile_pic.max' => 'Profile picture may not be greater than 2MB.',
            'address.required' => 'Address is required.',
            'github.url' => 'GitHub URL must be a valid URL.',
            'twitter.url' => 'Twitter URL must be a valid URL.',
            'facebook.url' => 'Facebook URL must be a valid URL.',
            'instagram.url' => 'Instagram URL must be a valid URL.',
            'linkedin.url' => 'LinkedIn URL must be a valid URL.',
        ];
    }
}
