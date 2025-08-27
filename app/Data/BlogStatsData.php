<?php

namespace App\Data;

class BlogStatsData
{
    public function __construct(
        public readonly int $totalUsers,
        public readonly int $totalBlogs,
        public readonly int $totalViews,
        public readonly int $activeWriters
    ) {}

    public function toArray(): array
    {
        return [
            'total_users' => $this->totalUsers,
            'total_blogs' => $this->totalBlogs,
            'total_views' => $this->totalViews,
            'active_writers' => $this->activeWriters,
        ];
    }
}
