<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Services\LoggingService;
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
            $siteSettings = SiteSetting::where('user_id', Auth::id())->first();

            LoggingService::logSiteSettings('retrieve', 'Site settings retrieved successfully', [
                'has_settings' => $siteSettings ? true : false
            ]);

            return $siteSettings;
        } catch (Exception $e) {
            LoggingService::logError($e, 'Error fetching user site settings', [
                'user_id' => Auth::id()
            ]);
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

            LoggingService::logSiteSettings('update', 'Site settings updated successfully', [
                'has_logo_upload' => isset($data['main_logo']),
                'updated_fields' => array_keys($data)
            ]);

            return $siteSettings;
        } catch (Exception $e) {
            LoggingService::logError($e, 'Error updating site settings', [
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
            LoggingService::logSiteSettings('logo_upload_attempt', 'User attempting to upload site logo', [
                'original_filename' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType()
            ]);

            // Delete existing logo files
            $this->deleteExistingLogos($siteSettings);

            // Create directory if it doesn't exist
            $logoDir = $user->name . '/site_settings/logos';
            Storage::disk('public')->makeDirectory($logoDir);

            // Check if GD extension is available for image processing
            if (extension_loaded('gd')) {
                $this->processLogoWithImageProcessing($file, $siteSettings, $logoDir);
            } else {
                $this->processLogoWithoutImageProcessing($file, $siteSettings, $logoDir);
            }

            $siteSettings->save();

            LoggingService::logSiteSettings('logo_upload_success', 'Site logo uploaded successfully');

        } catch (Exception $e) {
            LoggingService::logError($e, 'Failed to process logo upload');
            throw new Exception('Failed to process logo upload: ' . $e->getMessage());
        }
    }

    /**
     * Process logo upload with image processing (requires GD extension)
     *
     * @param UploadedFile $file
     * @param SiteSetting $siteSettings
     * @param string $logoDir
     */
    private function processLogoWithImageProcessing(UploadedFile $file, SiteSetting $siteSettings, string $logoDir)
    {
        // For now, we'll use simple upload without complex image processing
        // This can be enhanced later when GD extension is properly installed
        $this->processLogoWithoutImageProcessing($file, $siteSettings, $logoDir);
    }

    /**
     * Process logo upload without image processing
     *
     * @param UploadedFile $file
     * @param SiteSetting $siteSettings
     * @param string $logoDir
     */
    private function processLogoWithoutImageProcessing(UploadedFile $file, SiteSetting $siteSettings, string $logoDir)
    {
        // Get file extension
        $extension = $file->getClientOriginalExtension();

        // Create different sized filenames (we'll use the same file for all sizes for now)
        foreach ($this->logoSizes as $field => $config) {
            $filename = $field . '_' . time() . '.' . $extension;
            $fullPath = $logoDir . '/' . $filename;

            // Store the original file for each size requirement
            // In a production environment, you would want to actually resize these
            Storage::disk('public')->put($fullPath, file_get_contents($file->getPathname()));

            // Store the path in the database
            $siteSettings->$field = $fullPath;
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
                LoggingService::logSiteSettings('delete_attempt', 'Attempted to delete non-existent site settings');
                return false;
            }

            // Delete associated files
            $this->deleteExistingLogos($siteSettings);

            $siteSettings->delete();

            LoggingService::logSiteSettings('delete', 'Site settings deleted successfully');

            return true;
        } catch (Exception $e) {
            LoggingService::logError($e, 'Error deleting site settings');
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
            $siteSettings = SiteSetting::where('id', $id)
                            ->where('user_id', Auth::id())
                            ->first();

            LoggingService::logSiteSettings('retrieve_by_id', 'Site settings retrieved by ID', [
                'site_settings_id' => $id,
                'found' => $siteSettings ? true : false
            ]);

            return $siteSettings;
        } catch (Exception $e) {
            LoggingService::logError($e, 'Error fetching site settings by ID', [
                'site_settings_id' => $id
            ]);
            return null;
        }
    }
}
