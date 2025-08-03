<?php

namespace App\Traits;

trait SiteSettingsValidationTrait
{
    /**
     * Get validation rules for site settings
     *
     * @return array
     */
    public function siteSettingsRules()
    {
        return [
            'seo_description' => 'nullable|string|max:1000',
            'seo_keywords' => 'nullable|string|max:1000',
            'tawk_js' => 'nullable|string|max:10000',
            'main_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:10240', // 10MB max
        ];
    }

    /**
     * Get validation messages for site settings
     *
     * @return array
     */
    public function siteSettingsMessages()
    {
        return [
            'seo_description.max' => 'SEO description must not exceed 1000 characters.',
            'seo_keywords.max' => 'SEO keywords must not exceed 1000 characters.',
            'tawk_js.max' => 'Tawk.to JS code must not exceed 10000 characters.',
            'main_logo.image' => 'Logo must be a valid image file.',
            'main_logo.mimes' => 'Logo must be a JPEG, JPG, PNG, GIF, or WebP file.',
            'main_logo.max' => 'Logo size must not exceed 10MB.',
        ];
    }
}
