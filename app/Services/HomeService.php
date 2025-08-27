<?php

namespace App\Services;

use App\Actions\Blog\GetFeaturedBlogsAction;
use App\Actions\Blog\GetLatestBlogsAction;
use App\Actions\User\GetTopContributorsAction;
use App\Helpers\CacheHelper;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class HomeService
{
    public function __construct(
        private GetFeaturedBlogsAction $getFeaturedBlogsAction,
        private GetLatestBlogsAction $getLatestBlogsAction,
        private GetTopContributorsAction $getTopContributorsAction
    ) {}

    /**
     * Get homepage data with caching
     */
    public function getHomepageData(): array
    {
        return Cache::remember(
            CacheHelper::homepageDataKey(),
            CacheHelper::homepageCacheDuration(),
            function () {
                return [
                    'featuredBlogs' => $this->getFeaturedBlogs(),
                    'latestBlogs' => $this->getLatestBlogs(),
                    'stats' => $this->getOptimizedStats(),
                    'topContributors' => $this->getTopContributors(),
                    'popularTags' => $this->getPopularTags(),
                ];
            }
        );
    }

    /**
     * Get featured blogs for homepage
     */
    private function getFeaturedBlogs()
    {
        return $this->getFeaturedBlogsAction->execute(6);
    }

    /**
     * Get latest blogs for homepage
     */
    private function getLatestBlogs()
    {
        return $this->getLatestBlogsAction->execute(8);
    }

    /**
     * Get platform statistics with caching
     */
    private function getOptimizedStats(): array
    {
        return Cache::remember(
            CacheHelper::blogStatsKey(),
            CacheHelper::statsCacheDuration(),
            function () {
                return [
                    'total_users' => User::where('status', 'active')
                        ->where('user_type', 'user')
                        ->count(),
                    'total_blogs' => Blog::where('status', 'published')
                        ->whereHas('user', function($query) {
                            $query->where('status', 'active')
                                  ->where('user_type', 'user');
                        })
                        ->count(),
                    'total_views' => Blog::whereHas('user', function($query) {
                            $query->where('status', 'active')
                                  ->where('user_type', 'user');
                        })
                        ->sum('views_count'),
                    'active_writers' => User::where('status', 'active')
                        ->where('user_type', 'user')
                        ->whereHas('blogs', function($query) {
                            $query->where('status', 'published');
                        })
                        ->count(),
                ];
            }
        );
    }

    /**
     * Get top contributors with caching
     */
    private function getTopContributors()
    {
        return Cache::remember(
            CacheHelper::topContributorsKey(),
            CacheHelper::statsCacheDuration(),
            function () {
                return $this->getTopContributorsAction->execute(6);
            }
        );
    }

    /**
     * Get popular tags from published blogs
     */
    public function getPopularTags(): array
    {
        return Cache::remember(
            CacheHelper::popularTagsKey(),
            CacheHelper::statsCacheDuration(),
            function () {
                $blogs = Blog::where('status', 'published')
                    ->whereNotNull('tags')
                    ->whereHas('user', function($query) {
                        $query->where('status', 'active')
                              ->where('user_type', 'user');
                    })
                    ->pluck('tags');

                $allTags = [];
                foreach ($blogs as $blogTags) {
                    if (is_array($blogTags)) {
                        $allTags = array_merge($allTags, $blogTags);
                    } elseif (is_string($blogTags)) {
                        $tags = array_map('trim', explode(',', $blogTags));
                        $allTags = array_merge($allTags, $tags);
                    }
                }

                $tagCounts = array_count_values(array_filter($allTags));
                arsort($tagCounts);

                return array_slice($tagCounts, 0, 10, true);
            }
        );
    }

    /**
     * Get filtered blogs for all-blogs page
     */
    public function getFilteredBlogs($request)
    {
        $query = Blog::with(['user:id,name,slug'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->whereHas('user', function($q) {
                $q->where('status', 'active')
                  ->where('user_type', 'user');
            });

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('content', 'like', "%{$searchTerm}%");
            });
        }

        // Tag filtering
        if ($request->filled('tag')) {
            $query->where(function($q) use ($request) {
                $q->whereJsonContains('tags', $request->tag)
                  ->orWhere('tags', 'like', "%{$request->tag}%");
            });
        }

        // Sort options
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'popular':
                $query->orderBy('views_count', 'desc')
                      ->orderBy('published_at', 'desc');
                break;
            case 'featured':
                $query->orderByDesc('is_featured')
                      ->orderByDesc('published_at');
                break;
            case 'oldest':
                $query->orderBy('published_at', 'asc');
                break;
            case 'latest':
            default:
                $query->orderByDesc('published_at');
                break;
        }

        return $query->paginate(12)->withQueryString();
    }
}
