<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\EducationValidationTrait;

class EducationRequest extends FormRequest
{
    use EducationValidationTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->educationRules();
    }

    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'degree.required' => 'The degree field is required.',
            'degree.string' => 'The degree must be a valid text.',
            'degree.max' => 'The degree may not be greater than 255 characters.',
            
            'precentage.required' => 'The percentage or CGPA field is required.',
            'precentage.string' => 'The percentage or CGPA must be a valid text.',
            'precentage.max' => 'The percentage or CGPA may not be greater than 20 characters.',
            
            'from_date.required' => 'The from date is required.',
            'from_date.date' => 'The from date must be a valid date.',
            
            'to_date.date' => 'The to date must be a valid date.',
            'to_date.after_or_equal' => 'The to date must be after or equal to the from date.',
            
            'university.required' => 'The university field is required.',
            'university.string' => 'The university must be a valid text.',
            'university.max' => 'The university may not be greater than 255 characters.',
            
            'description.required' => 'The description field is required.',
            'description.string' => 'The description must be a valid text.',
            'description.max' => 'The description may not be greater than 1000 characters.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'precentage' => 'percentage or CGPA',
            'from_date' => 'from date',
            'to_date' => 'to date',
        ];
    }
}
