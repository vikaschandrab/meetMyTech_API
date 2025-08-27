<?php

namespace App\Helpers;

class CacheHelper
{
    /**
     * Generate cache key for homepage data
     */
    public static function homepageDataKey(): string
    {
        return 'homepage_data_' . date('Y-m-d-H');
    }

    /**
     * Generate cache key for blog stats
     */
    public static function blogStatsKey(): string
    {
        return 'homepage_stats';
    }

    /**
     * Generate cache key for top contributors
     */
    public static function topContributorsKey(): string
    {
        return 'top_contributors';
    }

    /**
     * Generate cache key for popular tags
     */
    public static function popularTagsKey(): string
    {
        return 'popular_tags';
    }

    /**
     * Get standard cache duration for homepage elements (30 minutes)
     */
    public static function homepageCacheDuration(): int
    {
        return 1800; // 30 minutes
    }

    /**
     * Get standard cache duration for stats (1 hour)
     */
    public static function statsCacheDuration(): int
    {
        return 3600; // 1 hour
    }
}
