<?php
namespace App\Traits;

trait EducationValidationTrait
{
    public function educationRules()
    {
        return [
            'degree' => 'required|string|max:255',
            'precentage' => 'required|string|max:20',
            'from_date' => 'required|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'university' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ];
    }
}
