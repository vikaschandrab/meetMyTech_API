<?php

namespace App\Helpers;

class ValidationHelper
{
    /**
     * Get common user validation rules
     */
    public static function userRules(bool $isUpdate = false, ?int $userId = null): array
    {
        $emailRule = 'required|string|email|max:255|unique:users,email';

        if ($isUpdate && $userId) {
            $emailRule .= ',' . $userId;
        }

        return [
            'name' => 'required|string|max:255',
            'email' => $emailRule,
        ];
    }

    /**
     * Get blog validation rules
     */
    public static function blogRules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'content' => 'required|string',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
        ];
    }

    /**
     * Get profile validation rules
     */
    public static function profileRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'nullable|string|max:20',
            'profilePic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Sanitize input data
     */
    public static function sanitizeInput(array $data): array
    {
        array_walk_recursive($data, function (&$value) {
            if (is_string($value)) {
                $value = trim($value);
            }
        });

        return $data;
    }

    /**
     * Format phone number
     */
    public static function formatPhone(?string $phone): ?string
    {
        if (!$phone) {
            return null;
        }

        return preg_replace('/[^0-9+\-\s()]/', '', $phone);
    }
}
