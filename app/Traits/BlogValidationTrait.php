<?php

namespace App\Traits;

trait BlogValidationTrait
{
    /**
     * Get validation rules for blog operations
     *
     * @param string $operation - 'create' or 'update'
     * @param int|null $blogId - For update operations
     * @return array
     */
    public function blogRules($operation = 'create', $blogId = null)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:51200', // 50MB max
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:1000',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'is_featured' => 'boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50',
        ];

        // Only add slug validation for create operations
        if ($operation === 'create') {
            $rules['slug'] = 'nullable|string|max:255|unique:blogs,slug';
        }

        return $rules;
    }

    /**
     * Get validation messages for blog operations
     *
     * @return array
     */
    public function blogMessages()
    {
        return [
            'title.required' => 'Blog title is required.',
            'title.max' => 'Blog title must not exceed 255 characters.',
            'description.max' => 'Blog description must not exceed 1000 characters.',
            'content.required' => 'Blog content is required.',
            'slug.unique' => 'This slug is already taken. Please choose another.',
            'slug.max' => 'Slug must not exceed 255 characters.',
            'featured_image.image' => 'Featured image must be a valid image file.',
            'featured_image.mimes' => 'Featured image must be a JPEG, JPG, PNG, GIF, or WebP file.',
            'featured_image.max' => 'Featured image must not exceed 50MB.',
            'meta_title.max' => 'Meta title must not exceed 255 characters.',
            'meta_description.max' => 'Meta description must not exceed 500 characters.',
            'meta_keywords.max' => 'Meta keywords must not exceed 1000 characters.',
            'status.required' => 'Blog status is required.',
            'status.in' => 'Blog status must be either draft, published, or archived.',
            'published_at.date' => 'Published date must be a valid date.',
            'is_featured.boolean' => 'Featured flag must be true or false.',
            'tags.array' => 'Tags must be an array.',
            'tags.*.string' => 'Each tag must be a string.',
            'tags.*.max' => 'Each tag must not exceed 50 characters.',
        ];
    }

    /**
     * Get validation rules for blog search/filter operations
     *
     * @return array
     */
    public function blogSearchRules()
    {
        return [
            'search' => 'nullable|string|max:255',
            'status' => 'nullable|in:draft,published,archived',
            'is_featured' => 'nullable|boolean',
            'user_id' => 'nullable|integer|exists:users,id',
            'per_page' => 'nullable|integer|min:1|max:100',
            'sort_by' => 'nullable|in:title,created_at,updated_at,published_at,views_count',
            'sort_order' => 'nullable|in:asc,desc',
        ];
    }

    /**
     * Get validation messages for blog search operations
     *
     * @return array
     */
    public function blogSearchMessages()
    {
        return [
            'search.max' => 'Search term must not exceed 255 characters.',
            'status.in' => 'Status must be either draft, published, or archived.',
            'is_featured.boolean' => 'Featured flag must be true or false.',
            'user_id.integer' => 'User ID must be an integer.',
            'user_id.exists' => 'Selected user does not exist.',
            'per_page.integer' => 'Per page must be an integer.',
            'per_page.min' => 'Per page must be at least 1.',
            'per_page.max' => 'Per page must not exceed 100.',
            'sort_by.in' => 'Sort by field is invalid.',
            'sort_order.in' => 'Sort order must be either asc or desc.',
        ];
    }
}
