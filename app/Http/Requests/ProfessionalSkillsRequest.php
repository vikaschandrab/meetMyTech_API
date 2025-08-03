<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ActivitiesValidationTrait;

class ProfessionalSkillsRequest extends FormRequest
{
    use ActivitiesValidationTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return $this->getProfessionalSkillsValidationRules();
    }

    /**
     * Get custom validation messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return $this->getProfessionalSkillsValidationMessages();
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'communication' => 'communication skill',
            'team_work' => 'team work skill',
            'project_management' => 'project management skill',
            'creativity' => 'creativity skill',
            'team_management' => 'team management skill',
            'active_participation' => 'active participation skill',
        ];
    }
}
