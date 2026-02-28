<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PublicBlogService
{
    public function __construct(private BlogService $blogService) {}

    /**
     * Build public blog detail payload.
     */
    public function getPublicBlogPageData(string $slug, Request $request): array
    {
        $blog = $this->blogService->getBlogBySlug($slug, true);

        if (!$blog || $blog->status !== 'published') {
            abort(404, 'Blog not found.');
        }

        $blog->load('user:id,name,email,slug,status');

        if (!$blog->user || $blog->user->status !== 'active') {
            abort(404, 'Blog not available. Author account is inactive.');
        }

        $blog->authorSlug = $blog->user->slug;

        $relatedBlogs = Blog::with('user:id,name,email,slug,status')
            ->where('user_id', $blog->user_id)
            ->where('id', '!=', $blog->id)
            ->where('status', 'published')
            ->whereHas('user', function ($query) {
                $query->where('status', 'active');
            })
            ->orderByDesc('published_at')
            ->limit(4)
            ->get()
            ->map(function (Blog $relatedBlog) {
                $relatedBlog->authorSlug = $relatedBlog->user->slug;
                return $relatedBlog;
            });

        $comments = Comment::query()
            ->where('blog_id', $blog->id)
            ->orderBy('created_at')
            ->get();

        $backInfo = RedirectService::getBlogBackUrl($request, $blog);

        return compact('blog', 'relatedBlogs', 'comments', 'backInfo');
    }

    /**
     * Store a comment against a published blog.
     */
    public function storeComment(string $slug, array $payload): array
    {
        try {
            $blog = $this->blogService->getBlogBySlug($slug, false);

            if (!$blog) {
                Log::warning('Blog not found for comment submission', ['slug' => $slug]);
                return ['success' => false, 'message' => 'Blog not found.'];
            }

            if ($blog->status !== 'published') {
                Log::warning('Attempted to comment on unpublished blog', ['slug' => $slug, 'status' => $blog->status]);
                return ['success' => false, 'message' => 'Blog not available for comments.'];
            }

            $blog->load('user');

            if (!$blog->user) {
                Log::error('Blog has no associated user', ['blog_id' => $blog->id, 'slug' => $slug]);
                return ['success' => false, 'message' => 'Unable to comment. Blog author information not available.'];
            }

            Log::info('Blog author status check', [
                'slug' => $slug,
                'author_id' => $blog->user->id,
                'author_status' => $blog->user->status ?? 'status_field_missing',
            ]);

            $comment = Comment::create([
                'blog_id' => $blog->id,
                'user_name' => trim($payload['user_name']),
                'message' => trim($payload['message']),
            ]);

            Log::info('Comment created successfully', [
                'comment_id' => $comment->id,
                'blog_slug' => $slug,
                'user_name' => $payload['user_name'],
            ]);

            return ['success' => true, 'message' => 'Your comment has been posted successfully!'];
        } catch (\Throwable $exception) {
            Log::error('Error storing comment: ' . $exception->getMessage(), [
                'slug' => $slug,
                'user_name' => $payload['user_name'] ?? 'unknown',
                'trace' => $exception->getTraceAsString(),
            ]);

            return ['success' => false, 'message' => 'Unable to post comment. Please try again.'];
        }
    }
}
