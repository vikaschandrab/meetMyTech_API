<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Exception;

class AboutService
{
    /**
     * Get user about data
     *
     * @return array
     */
    public function getAboutData(): array
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
     * Update user about section
     *
     * @param array $data
     * @return bool
     * @throws Exception
     */
    public function updateAbout(array $data): bool
    {
        try {
            /** @var User $user */
            $user = Auth::user();
            
            // Ensure user_details exists
            $details = $user->detail()->firstOrCreate([]);

            // Update description and technologies
            $details->about = $data['description'];
            $details->technologies = $data['technologies'];

            // Handle resume upload
            if (isset($data['resume'])) {
                $resumePath = $this->handleResumeUpload($data['resume'], $user, $details);
                $details->resume_filename = $resumePath;
            }

            $details->save();

            return true;
        } catch (Exception $e) {
            throw new Exception('Failed to update about section: ' . $e->getMessage());
        }
    }

    /**
     * Handle resume file upload
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param User $user
     * @param $details
     * @return string
     */
    private function handleResumeUpload($file, User $user, $details): string
    {
        // Delete old resume if exists
        if ($details->resume_filename && Storage::disk('public')->exists($details->resume_filename)) {
            Storage::disk('public')->delete($details->resume_filename);
        }

        // Generate unique filename
        $filename = 'resume_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $user->name . '/resumes/' . $filename;

        // Store the file
        $file->storeAs('public/' . dirname($path), basename($filename));

        return $path;
    }

    /**
     * Get formatted technologies list
     *
     * @param string|null $technologies
     * @return array
     */
    public function getFormattedTechnologies($technologies): array
    {
        if (!$technologies) {
            return [];
        }

        return array_map('trim', explode(',', $technologies));
    }

    /**
     * Check if user has resume
     *
     * @param $details
     * @return bool
     */
    public function hasResume($details): bool
    {
        return $details && $details->resume_filename && Storage::disk('public')->exists($details->resume_filename);
    }

    /**
     * Get resume URL
     *
     * @param $details
     * @return string|null
     */
    public function getResumeUrl($details): ?string
    {
        if ($this->hasResume($details)) {
            return asset('storage/' . $details->resume_filename);
        }

        return null;
    }
}
