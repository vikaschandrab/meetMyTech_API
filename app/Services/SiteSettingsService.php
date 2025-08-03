<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Exception;

class SiteSettingsService
{
    /**
     * Image size configurations for different logo formats
     */
    private $logoSizes = [
        'logo_png' => ['width' => 256, 'height' => 256, 'format' => 'png'],
        'logo_72_72_png' => ['width' => 72, 'height' => 72, 'format' => 'png'],
        'logo_114_114_png' => ['width' => 114, 'height' => 114, 'format' => 'png'],
        'logo_69_64_png' => ['width' => 69, 'height' => 64, 'format' => 'png'],
        'logo_16_14_png' => ['width' => 16, 'height' => 14, 'format' => 'png'],
        'logo_16_14_ico' => ['width' => 16, 'height' => 14, 'format' => 'png'], // Save as PNG for browser compatibility
    ];

    /**
     * Get site settings for the authenticated user
     *
     * @return SiteSetting|null
     */
    public function getUserSiteSettings()
    {
        try {
            return SiteSetting::where('user_id', Auth::id())->first();
        } catch (Exception $e) {
            Log::error('Error fetching user site settings: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Create or update site settings for the authenticated user
     *
     * @param array $data
     * @return SiteSetting|null
     */
    public function createOrUpdateSiteSettings(array $data)
    {
        try {
            $userId = Auth::id();
            $user = Auth::user();
            
            // Find existing settings or create new
            $siteSettings = SiteSetting::firstOrNew(['user_id' => $userId]);

            // Handle single logo upload and generate all formats
            if (isset($data['main_logo']) && $data['main_logo'] instanceof UploadedFile) {
                $this->processLogoUpload($data['main_logo'], $siteSettings, $user);
            }

            // Update text fields
            $siteSettings->seo_description = $data['seo_description'] ?? $siteSettings->seo_description;
            $siteSettings->seo_keywords = $data['seo_keywords'] ?? $siteSettings->seo_keywords;
            $siteSettings->tawk_js = $data['tawk_js'] ?? $siteSettings->tawk_js;
            $siteSettings->user_id = $userId;

            $siteSettings->save();

            Log::info('Site settings updated successfully', ['user_id' => $userId]);

            return $siteSettings;
        } catch (Exception $e) {
            Log::error('Error updating site settings: ' . $e->getMessage(), [
                'data' => $data,
                'user_id' => Auth::id()
            ]);
            return null;
        }
    }

    /**
     * Process logo upload and generate all required formats using Intervention Image
     *
     * @param UploadedFile $file
     * @param SiteSetting $siteSettings
     * @param User $user
     * @return void
     */
    private function processLogoUpload(UploadedFile $file, SiteSetting $siteSettings, $user)
    {
        try {
            // Delete existing logo files
            $this->deleteExistingLogos($siteSettings);

            // Create directory if it doesn't exist
            $logoDir = $user->name . '/site_settings/logos';
            Storage::disk('public')->makeDirectory($logoDir);

            // Load the uploaded image using Intervention Image
            $originalImage = Image::make($file->getPathname());

            foreach ($this->logoSizes as $field => $config) {
                $filename = $field . '_' . time() . '.' . $config['format'];
                $fullPath = $logoDir . '/' . $filename;

                // Create resized image with proper aspect ratio and padding
                $resizedImage = $originalImage->fit(
                    $config['width'], 
                    $config['height'], 
                    function ($constraint) {
                        $constraint->upsize(); // Prevent upsizing
                    }
                );

                // Save the image to storage
                Storage::disk('public')->put($fullPath, $resizedImage->encode($config['format'], 90));

                // Store the path in the database
                $siteSettings->$field = $fullPath;
            }

            Log::info('Logo upload processed successfully', [
                'user_id' => $user->id,
                'original_size' => $originalImage->width() . 'x' . $originalImage->height()
            ]);

        } catch (Exception $e) {
            Log::error('Error processing logo upload: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Delete existing logo files
     *
     * @param SiteSetting $siteSettings
     * @return void
     */
    private function deleteExistingLogos(SiteSetting $siteSettings)
    {
        foreach (array_keys($this->logoSizes) as $field) {
            if ($siteSettings->$field && Storage::disk('public')->exists($siteSettings->$field)) {
                Storage::disk('public')->delete($siteSettings->$field);
            }
        }
    }

    /**
     * Delete site settings for the authenticated user
     *
     * @return bool
     */
    public function deleteSiteSettings()
    {
        try {
            $siteSettings = SiteSetting::where('user_id', Auth::id())->first();
            
            if (!$siteSettings) {
                Log::warning('Attempted to delete non-existent site settings', ['user_id' => Auth::id()]);
                return false;
            }

            // Delete associated files
            $this->deleteExistingLogos($siteSettings);

            $siteSettings->delete();

            Log::info('Site settings deleted successfully', ['user_id' => Auth::id()]);

            return true;
        } catch (Exception $e) {
            Log::error('Error deleting site settings: ' . $e->getMessage(), [
                'user_id' => Auth::id()
            ]);
            return false;
        }
    }

    /**
     * Get site settings by ID (ensuring user ownership)
     *
     * @param int $id
     * @return SiteSetting|null
     */
    public function getSiteSettingsById(int $id)
    {
        try {
            return SiteSetting::where('id', $id)
                            ->where('user_id', Auth::id())
                            ->first();
        } catch (Exception $e) {
            Log::error('Error fetching site settings by ID: ' . $e->getMessage(), [
                'site_settings_id' => $id,
                'user_id' => Auth::id()
            ]);
            return null;
        }
    }
}
