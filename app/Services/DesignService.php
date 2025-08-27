<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class DesignService
{
    /**
     * Get or set the session design theme
     * 
     * @return int Design number (1, 2, or 3)
     */
    public static function getSessionDesign(): int
    {
        // Check if design is already set in session
        if (Session::has('design_theme')) {
            return Session::get('design_theme');
        }

        // If not set, randomly select and store in session
        $design = rand(1, 3);
        Session::put('design_theme', $design);
        
        return $design;
    }

    /**
     * Get login design template name based on session design
     * 
     * @return string Template name
     */
    public static function getLoginDesign(): string
    {
        $design = self::getSessionDesign();
        return "login_design_{$design}";
    }

    /**
     * Get forgot password design template name based on session design
     * 
     * @return string Template name
     */
    public static function getForgotPasswordDesign(): string
    {
        $design = self::getSessionDesign();
        return "forgot_password_design_{$design}";
    }

    /**
     * Get homepage design template name based on session design
     * 
     * @return string Template name
     */
    public static function getHomepageDesign(): string
    {
        $design = self::getSessionDesign();
        return "index_design_{$design}";
    }

    /**
     * Get contact design template name based on session design
     * 
     * @return string Template name
     */
    public static function getContactDesign(): string
    {
        $design = self::getSessionDesign();
        return "contact_design_{$design}";
    }

    /**
     * Get blog listing design template name based on session design
     * 
     * @return string Template name
     */
    public static function getBlogListingDesign(): string
    {
        $design = self::getSessionDesign();
        return "blog_design_{$design}";
    }

    /**
     * Get blog detail design template name based on session design
     * 
     * @return string Template name
     */
    public static function getBlogDetailDesign(): string
    {
        $design = self::getSessionDesign();
        return "blog_detail_{$design}";
    }

    /**
     * Get profile design template name based on session design
     * 
     * @return string Template name
     */
    public static function getProfileDesign(): string
    {
        $design = self::getSessionDesign();
        return "Design_{$design}";
    }

    /**
     * Force reset the session design (useful for testing or admin purposes)
     * 
     * @return int New design number
     */
    public static function resetSessionDesign(): int
    {
        Session::forget('design_theme');
        return self::getSessionDesign();
    }

    /**
     * Set a specific design for the session
     * 
     * @param int $design Design number (1, 2, or 3)
     * @return bool Success status
     */
    public static function setSessionDesign(int $design): bool
    {
        if ($design >= 1 && $design <= 3) {
            Session::put('design_theme', $design);
            return true;
        }
        
        return false;
    }

    /**
     * Get current design theme information
     * 
     * @return array Design theme info
     */
    public static function getDesignInfo(): array
    {
        $design = self::getSessionDesign();
        
        $themes = [
            1 => [
                'name' => 'Light Theme',
                'description' => 'Clean and modern light design',
                'colors' => ['#2563eb', '#f59e0b']
            ],
            2 => [
                'name' => 'Cyberpunk Theme', 
                'description' => 'Dark theme with gold accents and futuristic elements',
                'colors' => ['#ffd700', '#0a0a0a']
            ],
            3 => [
                'name' => 'Glassmorphism Theme',
                'description' => 'Modern glass effect with gradient backgrounds', 
                'colors' => ['#667eea', '#764ba2']
            ]
        ];

        return [
            'design_number' => $design,
            'theme_info' => $themes[$design] ?? $themes[1]
        ];
    }
}
