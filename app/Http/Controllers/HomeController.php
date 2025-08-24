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
        $data = Cache::remember('homepage_data', 1800, function () {
            return [
                // Get featured blogs (limit to 6 for homepage)
                'featuredBlogs' => Blog::with(['user:id,name,slug'])
                    ->where('status', 'published')
                    ->where('is_featured', true)
                    ->whereNotNull('published_at')
                    ->orderBy('published_at', 'desc')
                    ->limit(6)
                    ->get(),

                // Get latest blogs (limit to 8 for homepage)
                'latestBlogs' => Blog::with(['user:id,name,slug'])
                    ->where('status', 'published')
                    ->whereNotNull('published_at')
                    ->orderBy('published_at', 'desc')
                    ->limit(8)
                    ->get(),

                // Get platform statistics
                'stats' => [
                    'total_users' => User::count(),
                    'total_blogs' => Blog::where('status', 'published')->count(),
                    'total_views' => Blog::sum('views_count'),
                    'active_writers' => User::whereHas('blogs', function($query) {
                        $query->where('status', 'published');
                    })->count(),
                ],

                // Get top contributors (users with most published blogs)
                'topContributors' => User::select('id', 'name', 'slug', 'profilePic')
                    ->withCount(['blogs' => function($query) {
                        $query->where('status', 'published');
                    }])
                    ->having('blogs_count', '>', 0)
                    ->orderBy('blogs_count', 'desc')
                    ->limit(6)
                    ->get(),

                // Get popular tags
                'popularTags' => $this->getPopularTags(),
            ];
        });

        return view('home.index', $data);
    }

    /**
     * Get popular tags from published blogs
     */
    private function getPopularTags()
    {
        $blogs = Blog::where('status', 'published')
            ->whereNotNull('tags')
            ->pluck('tags');

        $allTags = [];
        foreach ($blogs as $blogTags) {
            if (is_array($blogTags)) {
                $allTags = array_merge($allTags, $blogTags);
            }
        }

        $tagCounts = array_count_values($allTags);
        arsort($tagCounts);

        return array_slice($tagCounts, 0, 10, true);
    }

    /**
     * Display all blogs page
     */
    public function allBlogs(Request $request)
    {
        $query = Blog::with(['user:id,name,slug'])
            ->where('status', 'published')
            ->whereNotNull('published_at');

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('content', 'like', "%{$searchTerm}%");
            });
        }

        // Tag filtering
        if ($request->has('tag') && !empty($request->tag)) {
            $query->whereJsonContains('tags', $request->tag);
        }

        // Sort options
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'popular':
                $query->orderBy('views_count', 'desc');
                break;
            case 'featured':
                $query->orderBy('is_featured', 'desc')
                      ->orderBy('published_at', 'desc');
                break;
            case 'latest':
            default:
                $query->orderBy('published_at', 'desc');
                break;
        }

        $blogs = $query->paginate(12);

        // Get popular tags for filter sidebar
        $popularTags = $this->getPopularTags();

        return view('home.all-blogs', compact('blogs', 'popularTags'));
    }
}
