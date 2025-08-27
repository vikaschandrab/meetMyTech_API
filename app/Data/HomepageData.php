<?php

namespace App\Data;

class HomepageData
{
    public function __construct(
        public readonly array $featuredBlogs,
        public readonly array $latestBlogs,
        public readonly array $stats,
        public readonly array $topContributors,
        public readonly array $popularTags
    ) {}

    public function toArray(): array
    {
        return [
            'featuredBlogs' => $this->featuredBlogs,
            'latestBlogs' => $this->latestBlogs,
            'stats' => $this->stats,
            'topContributors' => $this->topContributors,
            'popularTags' => $this->popularTags,
        ];
    }
}
