<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class GetTopContributorsAction
{
    public function execute(int $limit = 6): Collection
    {
        return User::select('id', 'name', 'slug', 'profilePic')
            ->where('status', 'active')
            ->where('user_type', 'user')
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->withCount(['blogs' => function($query) {
                $query->where('status', 'published');
            }])
            ->having('blogs_count', '>', 0)
            ->orderByDesc('blogs_count')
            ->limit($limit)
            ->get();
    }
}
