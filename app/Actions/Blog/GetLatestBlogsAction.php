<?php

namespace App\Actions\Blog;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Collection;

class GetLatestBlogsAction
{
    public function execute(int $limit = 8): Collection
    {
        return Blog::with(['user:id,name,slug'])
            ->select('id', 'title', 'description', 'published_at', 'views_count', 'user_id', 'slug', 'featured_image')
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->whereHas('user', function($query) {
                $query->where('status', 'active')
                      ->where('user_type', 'user');
            })
            ->orderByDesc('published_at')
            ->limit($limit)
            ->get();
    }
}
