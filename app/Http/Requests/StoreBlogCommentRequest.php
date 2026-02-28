<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'user_name' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ];

        if (!$this->shouldSkipCaptcha()) {
            $rules['g-recaptcha-response'] = 'required|captcha';
        }

        return $rules;
    }

    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            'user_name.required' => 'Please enter your name.',
            'user_name.max' => 'Name must not exceed 255 characters.',
            'message.required' => 'Please enter your comment.',
            'message.max' => 'Comment must not exceed 1000 characters.',
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            'g-recaptcha-response.captcha' => 'reCAPTCHA verification failed, please try again.',
        ];
    }

    /**
     * Skip captcha only for local environment when explicitly disabled.
     */
    private function shouldSkipCaptcha(): bool
    {
        return app()->environment('local') && config('captcha.disable_in_local', false);
    }
}
