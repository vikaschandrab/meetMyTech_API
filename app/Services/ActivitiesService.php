<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserActivity;
use App\Models\UserProfessionalSkill;
use Illuminate\Support\Facades\Auth;
use Exception;

class ActivitiesService
{
    /**
     * Get user activities and professional skills data
     *
     * @return array
     */
    public function getActivitiesData(): array
    {
        /** @var User $user */
        $user = Auth::user();
        $activities = $user->userActivity()->orderBy('created_at', 'desc')->get();
        $professionalSkills = $user->userProfessionalSkills->first();

        return [
            'user' => $user,
            'activities' => $activities,
            'professionalSkills' => $professionalSkills
        ];
    }

    /**
     * Create a new activity
     *
     * @param array $data
     * @return UserActivity
     * @throws Exception
     */
    public function createActivity(array $data): UserActivity
    {
        try {
            return UserActivity::create([
                'user_id' => Auth::id(),
                'action' => $data['workName'],
                'description' => $data['description'],
            ]);
        } catch (Exception $e) {
            throw new Exception('Failed to create activity: ' . $e->getMessage());
        }
    }

    /**
     * Update an existing activity
     *
     * @param int $id
     * @param array $data
     * @return UserActivity
     * @throws Exception
     */
    public function updateActivity(int $id, array $data): UserActivity
    {
        try {
            $activity = UserActivity::findOrFail($id);

            // Ensure the activity belongs to the current user
            if ($activity->user_id !== Auth::id()) {
                throw new Exception('Unauthorized to update this activity.');
            }

            $activity->update([
                'action' => $data['workName'],
                'description' => $data['description'],
            ]);

            return $activity->fresh();
        } catch (Exception $e) {
            throw new Exception('Failed to update activity: ' . $e->getMessage());
        }
    }

    /**
     * Delete an activity
     *
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function deleteActivity(int $id): bool
    {
        try {
            $activity = UserActivity::findOrFail($id);

            // Ensure the activity belongs to the current user
            if ($activity->user_id !== Auth::id()) {
                throw new Exception('Unauthorized to delete this activity.');
            }

            return $activity->delete();
        } catch (Exception $e) {
            throw new Exception('Failed to delete activity: ' . $e->getMessage());
        }
    }

    /**
     * Update professional skills
     *
     * @param array $data
     * @return UserProfessionalSkill
     * @throws Exception
     */
    public function updateProfessionalSkills(array $data): UserProfessionalSkill
    {
        try {
            /** @var User $user */
            $user = Auth::user();

            $professionalSkill = UserProfessionalSkill::firstOrNew(['user_id' => $user->id]);
            $professionalSkill->fill($data);
            $professionalSkill->save();

            return $professionalSkill;
        } catch (Exception $e) {
            throw new Exception('Failed to update professional skills: ' . $e->getMessage());
        }
    }

    /**
     * Get activity by ID with user check
     *
     * @param int $id
     * @return UserActivity
     * @throws Exception
     */
    public function getActivity(int $id): UserActivity
    {
        $activity = UserActivity::findOrFail($id);

        if ($activity->user_id !== Auth::id()) {
            throw new Exception('Unauthorized to access this activity.');
        }

        return $activity;
    }

    /**
     * Get professional skills with default values
     *
     * @return array
     */
    public function getProfessionalSkillsWithDefaults(): array
    {
        $user = Auth::user();
        $skills = $user->userProfessionalSkills->first();

        $defaultSkills = [
            'communication' => 80,
            'team_work' => 85,
            'project_management' => 75,
            'creativity' => 90,
            'team_management' => 70,
            'active_participation' => 95,
        ];

        if (!$skills) {
            return $defaultSkills;
        }

        return [
            'communication' => $skills->communication ?? $defaultSkills['communication'],
            'team_work' => $skills->team_work ?? $defaultSkills['team_work'],
            'project_management' => $skills->project_management ?? $defaultSkills['project_management'],
            'creativity' => $skills->creativity ?? $defaultSkills['creativity'],
            'team_management' => $skills->team_management ?? $defaultSkills['team_management'],
            'active_participation' => $skills->active_participation ?? $defaultSkills['active_participation'],
        ];
    }

    /**
     * Check if user has activities
     *
     * @return bool
     */
    public function hasActivities(): bool
    {
        return Auth::user()->userActivity()->exists();
    }

    /**
     * Get activities count
     *
     * @return int
     */
    public function getActivitiesCount(): int
    {
        return Auth::user()->userActivity()->count();
    }
}
