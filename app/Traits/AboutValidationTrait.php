<?php

namespace App\Traits;

trait AboutValidationTrait
{
    /**
     * Get validation rules for about section update
     *
     * @return array
     */
    public function getAboutValidationRules(): array
    {
        return [
            'description' => 'required|string|min:10|max:5000',
            'technologies' => 'required|string|max:1000',
            'resume' => 'nullable|file|mimes:pdf|max:10240', // 10MB max
        ];
    }

    /**
     * Get validation messages for about section update
     *
     * @return array
     */
    public function getAboutValidationMessages(): array
    {
        return [
            'description.required' => 'Description is required.',
            'description.min' => 'Description must be at least 10 characters.',
            'description.max' => 'Description may not be greater than 5000 characters.',
            'technologies.required' => 'Technologies field is required.',
            'technologies.max' => 'Technologies may not be greater than 1000 characters.',
            'resume.file' => 'Resume must be a file.',
            'resume.mimes' => 'Resume must be a PDF file.',
            'resume.max' => 'Resume file size may not be greater than 10MB.',
        ];
    }
}
