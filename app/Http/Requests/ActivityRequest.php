<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ActivitiesValidationTrait;

class ActivityRequest extends FormRequest
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
        $isUpdate = $this->has('id') && !empty($this->input('id'));
        return $this->getActivityValidationRules($isUpdate);
    }

    /**
     * Get custom validation messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return $this->getActivityValidationMessages();
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'workName' => 'work name',
            'description' => 'description',
        ];
    }
}
