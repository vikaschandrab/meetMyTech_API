<?php

namespace App\Traits;

trait WorkExperienceValidationTrait
{
    /**
     * Get validation rules for work experience
     *
     * @return array
     */
    public function workExperienceRules()
    {
        return [
            'position' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'from_date' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'to_date' => 'nullable|integer|min:1900|max:' . (date('Y') + 10) . '|gte:from_date',
            'roles_and_responsibilities' => 'required|string|min:10|max:5000',
        ];
    }

    /**
     * Get validation messages for work experience
     *
     * @return array
     */
    public function workExperienceMessages()
    {
        return [
            'position.required' => 'Position is required.',
            'position.max' => 'Position must not exceed 255 characters.',
            'organization.required' => 'Organization is required.',
            'organization.max' => 'Organization must not exceed 255 characters.',
            'from_date.required' => 'From date is required.',
            'from_date.integer' => 'From date must be a valid year.',
            'from_date.min' => 'From date must be at least 1900.',
            'from_date.max' => 'From date cannot be more than 10 years in the future.',
            'to_date.integer' => 'To date must be a valid year.',
            'to_date.min' => 'To date must be at least 1900.',
            'to_date.max' => 'To date cannot be more than 10 years in the future.',
            'to_date.gte' => 'To date must be greater than or equal to from date.',
            'roles_and_responsibilities.required' => 'Roles and responsibilities are required.',
            'roles_and_responsibilities.min' => 'Roles and responsibilities must be at least 10 characters.',
            'roles_and_responsibilities.max' => 'Roles and responsibilities must not exceed 5000 characters.',
        ];
    }
}
