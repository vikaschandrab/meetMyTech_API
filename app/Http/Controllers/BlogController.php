<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Blog;
use App\Services\BlogService;
use App\Services\LoggingService;
use App\Services\DesignService;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\BlogSearchRequest;
use Exception;

class BlogController extends Controller
{
    protected $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the user's blogs
     *
     * @param BlogSearchRequest $request
     * @return \Illuminate\View\View
     */
    public function index(BlogSearchRequest $request)
    {
        try {
            $userId = Auth::id();

            if (!$userId) {
                return redirect()->route('login')->with('error', 'Please log in to access your blogs.');
            }

            LoggingService::logBlog('blog_index_view', 'User viewed blogs listing page', [
                'user_id' => $userId,
                'filters' => $request->validated()
            ]);

            $filters = $request->validated();
            $blogs = $this->blogService->getUserBlogs($userId, $filters);
            $stats = $this->blogService->getBlogStatistics($userId);
            $hasBlogs = $blogs->total() > 0;
            $totalBlogs = $stats['total'] ?? 0;

            // Enhanced logging for debugging
            Log::info('Blog Index Page Loaded', [
                'user_id' => $userId,
                'stats' => $stats,
                'blogs_count' => $blogs->total(),
                'has_blogs' => $hasBlogs,
                'filters' => $filters
            ]);

            return view('Users.Pages.blogs.index', compact('blogs', 'stats', 'filters', 'hasBlogs', 'totalBlogs'));
        } catch (Exception $e) {
            Log::error('Blog Index Error: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);

            LoggingService::logError($e, 'blog', [
                'action' => 'blog_index_failed'
            ]);

            return redirect()->back()->with('error', 'Failed to load blogs. Please try again.');
        }
    }

    /**
     * Show the form for creating a new blog
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('Users.Pages.blogs.create');
    }

    /**
     * Store a newly created blog
     *
     * @param BlogRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BlogRequest $request)
    {
        try {
            $blog = $this->blogService->createBlog($request->validated());

            if ($blog) {
                $action = $request->input('action', 'save');

                if ($blog->status === 'published') {
                    $message = 'Blog published successfully!';
                    if ($action === 'save_continue') {
                        return redirect()->route('blogs.edit', $blog->slug)->with('success', $message);
                    } else {
                        return redirect()->route('blogs.show', $blog->slug)->with('success', $message);
                    }
                } else {
                    // For drafts, always go to edit page
                    $message = 'Blog saved as draft!';
                    return redirect()->route('blogs.edit', $blog->slug)->with('success', $message);
                }
            } else {
                return redirect()->back()->withInput()->with('error', 'Failed to create blog. Please try again.');
            }
        } catch (Exception $e) {
            Log::error('Error creating blog: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to create blog. Please try again.');
        }
    }

    /**
     * Display the specified blog (preview for owners, public view for published)
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function show(string $slug)
    {
        try {
            // For drafts, don't increment views. For published blogs by owner, don't increment
            $shouldIncrementViews = true;
            $blog = $this->blogService->getBlogBySlug($slug, false); // Don't increment yet

            if (!$blog) {
                return redirect()->route('blogs.index')->with('error', 'Blog not found.');
            }

            // Check if user can view this blog
            if ($blog->status !== 'published' && $blog->user_id !== Auth::id()) {
                return redirect()->route('blogs.index')->with('error', 'Blog not found.');
            }

            // Only increment views for published blogs and if viewer is not the owner
            if ($blog->status === 'published' && $blog->user_id !== Auth::id()) {
                $blog->incrementViews();
            }

            // If user is viewing their own blog (preview mode), use admin view
            if ($blog->user_id === Auth::id()) {
                return view('Users.Pages.blogs.show', compact('blog'));
            }

            // For public viewing of published blogs, use session-based design template selection
            if ($blog->status === 'published') {
                $selectedDesign = DesignService::getBlogDetailDesign();

                return view('home.' . strtolower($selectedDesign), compact('blog'));
            }

            return view('Users.Pages.blogs.show', compact('blog'));
        } catch (Exception $e) {
            Log::error('Error showing blog: ' . $e->getMessage(), ['slug' => $slug]);
            return redirect()->route('blogs.index')->with('error', 'Failed to load blog. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified blog
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function edit(string $slug)
    {
        try {
            $blog = $this->blogService->getBlogBySlug($slug);

            if (!$blog) {
                return redirect()->route('blogs.index')->with('error', 'Blog not found.');
            }

            // Check if user owns this blog
            if ($blog->user_id !== Auth::id()) {
                return redirect()->route('blogs.index')->with('error', 'You can only edit your own blogs.');
            }

            return view('Users.Pages.blogs.edit', compact('blog'));
        } catch (Exception $e) {
            Log::error('Error loading blog for edit: ' . $e->getMessage(), ['slug' => $slug]);
            return redirect()->route('blogs.index')->with('error', 'Failed to load blog for editing.');
        }
    }

    /**
     * Update the specified blog
     *
     * @param BlogRequest $request
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BlogRequest $request, string $slug)
    {
        try {
            $blog = $this->blogService->getBlogBySlug($slug);

            if (!$blog) {
                return redirect()->route('blogs.index')->with('error', 'Blog not found.');
            }

            // Check if user owns this blog
            if ($blog->user_id !== Auth::id()) {
                return redirect()->route('blogs.index')->with('error', 'You can only edit your own blogs.');
            }

            $updatedBlog = $this->blogService->updateBlog($blog, $request->validated());

            if ($updatedBlog) {
                $action = $request->input('action', 'save');

                if ($updatedBlog->status === 'published') {
                    $message = 'Blog updated and published!';
                    if ($action === 'save_continue') {
                        return redirect()->route('blogs.edit', $updatedBlog->slug)->with('success', $message);
                    } else {
                        return redirect()->route('blogs.show', $updatedBlog->slug)->with('success', $message);
                    }
                } else {
                    // For drafts, stay on edit page
                    $message = 'Blog updated successfully!';
                    return redirect()->route('blogs.edit', $updatedBlog->slug)->with('success', $message);
                }
            } else {
                return redirect()->back()->withInput()->with('error', 'Failed to update blog. Please try again.');
            }
        } catch (Exception $e) {
            Log::error('Error updating blog: ' . $e->getMessage(), ['slug' => $slug]);
            return redirect()->back()->withInput()->with('error', 'Failed to update blog. Please try again.');
        }
    }

    /**
     * Remove the specified blog
     *
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $slug)
    {
        try {
            $blog = $this->blogService->getBlogBySlug($slug);

            if (!$blog) {
                return redirect()->route('blogs.index')->with('error', 'Blog not found.');
            }

            // Check if user owns this blog
            if ($blog->user_id !== Auth::id()) {
                return redirect()->route('blogs.index')->with('error', 'You can only delete your own blogs.');
            }

            if ($this->blogService->deleteBlog($blog)) {
                return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to delete blog. Please try again.');
            }
        } catch (Exception $e) {
            Log::error('Error deleting blog: ' . $e->getMessage(), ['slug' => $slug]);
            return redirect()->back()->with('error', 'Failed to delete blog. Please try again.');
        }
    }

    /**
     * Toggle featured status of a blog
     *
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleFeatured(string $slug)
    {
        try {
            $blog = $this->blogService->getBlogBySlug($slug);

            if (!$blog || $blog->user_id !== Auth::id()) {
                return redirect()->route('blogs.index')->with('error', 'Blog not found or unauthorized.');
            }

            $blog->update(['is_featured' => !$blog->is_featured]);

            $message = $blog->is_featured ? 'Blog marked as featured!' : 'Blog removed from featured!';
            return redirect()->back()->with('success', $message);
        } catch (Exception $e) {
            Log::error('Error toggling featured status: ' . $e->getMessage(), ['slug' => $slug]);
            return redirect()->back()->with('error', 'Failed to update featured status.');
        }
    }

    /**
     * Duplicate a blog
     *
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function duplicate(string $slug)
    {
        try {
            $originalBlog = $this->blogService->getBlogBySlug($slug);

            if (!$originalBlog || $originalBlog->user_id !== Auth::id()) {
                return redirect()->route('blogs.index')->with('error', 'Blog not found or unauthorized.');
            }

            $duplicateData = $originalBlog->toArray();
            $duplicateData['title'] = $duplicateData['title'] . ' (Copy)';
            $duplicateData['slug'] = null; // Let the model generate a new slug
            $duplicateData['status'] = 'draft';
            $duplicateData['published_at'] = null;
            $duplicateData['views_count'] = 0;
            $duplicateData['is_featured'] = false;

            // Remove fields that shouldn't be duplicated
            unset($duplicateData['id'], $duplicateData['created_at'], $duplicateData['updated_at'], $duplicateData['deleted_at']);

            $newBlog = $this->blogService->createBlog($duplicateData);

            if ($newBlog) {
                return redirect()->route('blogs.edit', $newBlog->slug)->with('success', 'Blog duplicated successfully! You can now edit the copy.');
            } else {
                return redirect()->back()->with('error', 'Failed to duplicate blog.');
            }
        } catch (Exception $e) {
            Log::error('Error duplicating blog: ' . $e->getMessage(), ['slug' => $slug]);
            return redirect()->back()->with('error', 'Failed to duplicate blog.');
        }
    }

    /**
     * Display a listing of published blogs for public viewing
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function publicIndex(Request $request)
    {
        try {
            $filters = [
                'search' => $request->get('search'),
                'per_page' => $request->get('per_page', 12),
                'sort_by' => $request->get('sort_by', 'published_at'),
                'sort_order' => $request->get('sort_order', 'desc')
            ];

            $blogs = $this->blogService->getPublishedBlogs($filters);

            return view('public.blogs.index', compact('blogs', 'filters'));
        } catch (Exception $e) {
            Log::error('Error loading public blogs: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load blogs. Please try again.');
        }
    }
}
