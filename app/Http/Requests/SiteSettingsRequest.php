<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\SiteSettingsValidationTrait;

class SiteSettingsRequest extends FormRequest
{
    use SiteSettingsValidationTrait;

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
        return $this->siteSettingsRules();
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return $this->siteSettingsMessages();
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'main_logo' => 'logo image',
            'seo_description' => 'SEO meta description',
            'seo_keywords' => 'SEO meta keywords',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Clean up SEO fields
        if ($this->has('seo_description')) {
            $this->merge([
                'seo_description' => trim($this->seo_description)
            ]);
        }

        if ($this->has('seo_keywords')) {
            $this->merge([
                'seo_keywords' => trim($this->seo_keywords)
            ]);
        }
    }

    /**
     * Get the validated data from the request with additional processing.
     *
     * @param array|null $key
     * @param mixed $default
     * @return mixed
     */
    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);

        // Process SEO keywords to ensure proper formatting
        if (isset($validated['seo_keywords']) && $validated['seo_keywords']) {
            $validated['seo_keywords'] = $this->formatSeoKeywords($validated['seo_keywords']);
        }

        return is_null($key) ? $validated : $validated[$key] ?? $default;
    }

    /**
     * Format SEO keywords for consistency
     *
     * @param string $keywords
     * @return string
     */
    private function formatSeoKeywords(string $keywords): string
    {
        // Split by comma, trim each keyword, remove empties, and rejoin
        $keywordArray = array_filter(
            array_map('trim', explode(',', $keywords)),
            function($keyword) {
                return !empty($keyword);
            }
        );

        return implode(', ', $keywordArray);
    }
}
