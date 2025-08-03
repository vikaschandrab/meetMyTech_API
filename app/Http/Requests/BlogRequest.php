<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\BlogValidationTrait;

class BlogRequest extends FormRequest
{
    use BlogValidationTrait;

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
        $operation = $this->isMethod('POST') ? 'create' : 'update';
        $blogId = $this->route('blog') ? $this->route('blog') : null;
        
        return $this->blogRules($operation, $blogId);
    }

    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return $this->blogMessages();
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'featured_image' => 'featured image',
            'meta_title' => 'meta title',
            'meta_description' => 'meta description',
            'meta_keywords' => 'meta keywords',
            'published_at' => 'publication date',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        // Convert tags from JSON string to array if needed
        if ($this->has('tags') && is_string($this->tags)) {
            $this->merge([
                'tags' => json_decode($this->tags, true) ?: []
            ]);
        }

        // Set published_at if status is published and no date is set
        if ($this->status === 'published' && !$this->published_at) {
            $this->merge([
                'published_at' => now()
            ]);
        }
    }
}
