<?php

namespace App\Traits;

trait ActivitiesValidationTrait
{
    /**
     * Get validation rules for activity operations
     *
     * @param bool $isUpdate
     * @return array
     */
    public function getActivityValidationRules(bool $isUpdate = false): array
    {
        return [
            'workName' => 'required|string|max:255',
            'description' => 'required|string|min:10|max:2000',
            'id' => $isUpdate ? 'required|exists:user_activities,id' : '',
        ];
    }

    /**
     * Get validation rules for professional skills
     *
     * @return array
     */
    public function getProfessionalSkillsValidationRules(): array
    {
        return [
            'communication' => 'required|integer|min:0|max:100',
            'team_work' => 'required|integer|min:0|max:100',
            'project_management' => 'required|integer|min:0|max:100',
            'creativity' => 'required|integer|min:0|max:100',
            'team_management' => 'required|integer|min:0|max:100',
            'active_participation' => 'required|integer|min:0|max:100',
        ];
    }

    /**
     * Get validation messages for activities
     *
     * @return array
     */
    public function getActivityValidationMessages(): array
    {
        return [
            'workName.required' => 'Work name is required.',
            'workName.max' => 'Work name may not be greater than 255 characters.',
            'description.required' => 'Description is required.',
            'description.min' => 'Description must be at least 10 characters.',
            'description.max' => 'Description may not be greater than 2000 characters.',
            'id.required' => 'Activity ID is required for updates.',
            'id.exists' => 'Selected activity does not exist.',
        ];
    }

    /**
     * Get validation messages for professional skills
     *
     * @return array
     */
    public function getProfessionalSkillsValidationMessages(): array
    {
        return [
            '*.required' => 'This field is required.',
            '*.integer' => 'This field must be a number.',
            '*.min' => 'This field must be at least 0.',
            '*.max' => 'This field may not be greater than 100.',
        ];
    }
}
