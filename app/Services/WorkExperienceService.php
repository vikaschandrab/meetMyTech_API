<?php

namespace App\Services;

use App\Models\WorkExperience;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class WorkExperienceService
{
    /**
     * Get all work experiences for the authenticated user
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUserWorkExperiences()
    {
        try {
            return WorkExperience::where('user_id', Auth::id())
                                ->orderBy('from_date', 'desc')
                                ->get();
        } catch (Exception $e) {
            Log::error('Error fetching user work experiences: ' . $e->getMessage());
            return collect();
        }
    }

    /**
     * Add new work experience for the authenticated user
     *
     * @param array $data
     * @return WorkExperience|null
     */
    public function addWorkExperience(array $data)
    {
        try {
            $data['user_id'] = Auth::id();

            $workExperience = WorkExperience::create($data);

            Log::info('Work experience created successfully', ['work_experience_id' => $workExperience->id]);

            return $workExperience;
        } catch (Exception $e) {
            Log::error('Error creating work experience: ' . $e->getMessage(), [
                'data' => $data,
                'user_id' => Auth::id()
            ]);
            return null;
        }
    }

    /**
     * Update work experience for the authenticated user
     *
     * @param int $id
     * @param array $data
     * @return WorkExperience|null
     */
    public function updateWorkExperience($id, array $data)
    {
        try {
            $workExperience = WorkExperience::where('id', $id)
                                          ->where('user_id', Auth::id())
                                          ->first();

            if (!$workExperience) {
                Log::warning('Work experience not found or unauthorized access', [
                    'work_experience_id' => $id,
                    'user_id' => Auth::id()
                ]);
                return null;
            }

            $workExperience->update($data);

            Log::info('Work experience updated successfully', ['work_experience_id' => $id]);

            return $workExperience;
        } catch (Exception $e) {
            Log::error('Error updating work experience: ' . $e->getMessage(), [
                'work_experience_id' => $id,
                'data' => $data,
                'user_id' => Auth::id()
            ]);
            return null;
        }
    }

    /**
     * Delete work experience for the authenticated user
     *
     * @param int $id
     * @return bool
     */
    public function deleteWorkExperience($id)
    {
        try {
            $workExperience = WorkExperience::where('id', $id)
                                          ->where('user_id', Auth::id())
                                          ->first();

            if (!$workExperience) {
                Log::warning('Work experience not found or unauthorized access', [
                    'work_experience_id' => $id,
                    'user_id' => Auth::id()
                ]);
                return false;
            }

            $workExperience->delete();

            Log::info('Work experience deleted successfully', ['work_experience_id' => $id]);

            return true;
        } catch (Exception $e) {
            Log::error('Error deleting work experience: ' . $e->getMessage(), [
                'work_experience_id' => $id,
                'user_id' => Auth::id()
            ]);
            return false;
        }
    }

    /**
     * Get work experience by ID for the authenticated user
     *
     * @param int $id
     * @return WorkExperience|null
     */
    public function getWorkExperienceById($id)
    {
        try {
            return WorkExperience::where('id', $id)
                                ->where('user_id', Auth::id())
                                ->first();
        } catch (Exception $e) {
            Log::error('Error fetching work experience by ID: ' . $e->getMessage(), [
                'work_experience_id' => $id,
                'user_id' => Auth::id()
            ]);
            return null;
        }
    }
}
