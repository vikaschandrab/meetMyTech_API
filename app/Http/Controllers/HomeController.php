<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Display the homepage
     */
    public function index()
    {
        // Cache the data for 30 minutes to improve performance
        // Use different cache keys for better granular control
        $cacheKey = 'homepage_data_' . date('Y-m-d-H');
        
        $data = Cache::remember($cacheKey, 1800, function () {
            return [
                // Get featured blogs (limit to 6 for homepage)
                'featuredBlogs' => Blog::with(['user:id,name,slug'])
                    ->select('id', 'title', 'description', 'blog_image', 'published_at', 'views_count', 'user_id', 'slug')
                    ->where('status', 'published')
                    ->where('is_featured', true)
                    ->whereNotNull('published_at')
                    ->whereHas('user', function($query) {
                        $query->where('status', 'active')
                              ->where('user_type', 'user');
                    })
                    ->orderByDesc('published_at')
                    ->limit(6)
                    ->get(),

                // Get latest blogs (limit to 8 for homepage)
                'latestBlogs' => Blog::with(['user:id,name,slug'])
                    ->select('id', 'title', 'description', 'blog_image', 'published_at', 'views_count', 'user_id', 'slug')
                    ->where('status', 'published')
                    ->whereNotNull('published_at')
                    ->whereHas('user', function($query) {
                        $query->where('status', 'active')
                              ->where('user_type', 'user');
                    })
                    ->orderByDesc('published_at')
                    ->limit(8)
                    ->get(),

                // Get platform statistics
                'stats' => $this->getOptimizedStats(),

                // Get top contributors (users with most published blogs)
                'topContributors' => $this->getTopContributors(),

                // Get popular tags
                'popularTags' => $this->getPopularTags(),
            ];
        });

        return view('home.index', $data);
    }

    /**
     * Get optimized statistics
     */
    private function getOptimizedStats()
    {
        return Cache::remember('homepage_stats', 3600, function () {
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
        });
    }

    /**
     * Get top contributors with caching
     */
    private function getTopContributors()
    {
        return Cache::remember('top_contributors', 3600, function () {
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
                ->limit(6)
                ->get();
        });
    }

    /**
     * Get popular tags from published blogs
     */
    private function getPopularTags()
    {
        return Cache::remember('popular_tags', 3600, function () {
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
                    // Handle comma-separated tags as string
                    $tags = array_map('trim', explode(',', $blogTags));
                    $allTags = array_merge($allTags, $tags);
                }
            }

            $tagCounts = array_count_values(array_filter($allTags));
            arsort($tagCounts);

            return array_slice($tagCounts, 0, 10, true);
        });
    }

    /**
     * Display all blogs page
     */
    public function allBlogs(Request $request)
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

        $blogs = $query->paginate(12)->withQueryString();

        // Get popular tags for filter sidebar
        $popularTags = $this->getPopularTags();

        return view('home.all-blogs', compact('blogs', 'popularTags'));
    }
}
