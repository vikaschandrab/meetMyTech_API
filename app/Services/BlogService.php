<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Exception;

class BlogService
{
    /**
     * Get paginated blogs with optional filters
     *
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getBlogsWithFilters(array $filters = [])
    {
        try {
            $query = Blog::with('user:id,name,email')
                         ->select(['id', 'user_id', 'title', 'description', 'slug', 'featured_image', 
                                  'status', 'published_at', 'views_count', 'is_featured', 'reading_time', 
                                  'created_at', 'updated_at']);

            // Apply filters
            if (isset($filters['search']) && !empty($filters['search'])) {
                $searchTerm = $filters['search'];
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('title', 'like', "%{$searchTerm}%")
                      ->orWhere('description', 'like', "%{$searchTerm}%")
                      ->orWhere('content', 'like', "%{$searchTerm}%");
                });
            }

            if (isset($filters['status'])) {
                $query->where('status', $filters['status']);
            }

            if (isset($filters['is_featured'])) {
                $query->where('is_featured', $filters['is_featured']);
            }

            if (isset($filters['user_id'])) {
                $query->where('user_id', $filters['user_id']);
            }

            // Apply sorting
            $sortBy = $filters['sort_by'] ?? 'created_at';
            $sortOrder = $filters['sort_order'] ?? 'desc';
            $query->orderBy($sortBy, $sortOrder);

            // Get per page count
            $perPage = $filters['per_page'] ?? 10;

            return $query->paginate($perPage);
        } catch (Exception $e) {
            Log::error('Error fetching blogs with filters: ' . $e->getMessage(), $filters);
            throw $e;
        }
    }

    /**
     * Get blog by slug
     *
     * @param string $slug
     * @param bool $incrementViews
     * @return Blog|null
     */
    public function getBlogBySlug(string $slug, bool $incrementViews = false)
    {
        try {
            $blog = Blog::with('user:id,name,email')
                       ->where('slug', $slug)
                       ->first();

            if ($blog && $incrementViews) {
                $blog->incrementViews();
            }

            return $blog;
        } catch (Exception $e) {
            Log::error('Error fetching blog by slug: ' . $e->getMessage(), ['slug' => $slug]);
            return null;
        }
    }

    /**
     * Create a new blog
     *
     * @param array $data
     * @return Blog|null
     */
    public function createBlog(array $data)
    {
        try {
            $userId = Auth::id();
            $user = Auth::user();

            // Handle featured image upload
            if (isset($data['featured_image']) && $data['featured_image'] instanceof UploadedFile) {
                $data['featured_image'] = $this->processFeaturedImage($data['featured_image'], $user);
            }

            // Set user_id
            $data['user_id'] = $userId;

            // Handle published_at
            if ($data['status'] === 'published' && empty($data['published_at'])) {
                $data['published_at'] = now();
            }

            $blog = Blog::create($data);

            Log::info('Blog created successfully', ['blog_id' => $blog->id, 'user_id' => $userId]);

            return $blog;
        } catch (Exception $e) {
            Log::error('Error creating blog: ' . $e->getMessage(), [
                'data' => $data,
                'user_id' => Auth::id()
            ]);
            return null;
        }
    }

    /**
     * Update an existing blog
     *
     * @param Blog $blog
     * @param array $data
     * @return Blog|null
     */
    public function updateBlog(Blog $blog, array $data)
    {
        try {
            $user = Auth::user();

            // Handle featured image upload
            if (isset($data['featured_image']) && $data['featured_image'] instanceof UploadedFile) {
                // Delete old image
                if ($blog->featured_image) {
                    $this->deleteFeaturedImage($blog->featured_image);
                }
                $data['featured_image'] = $this->processFeaturedImage($data['featured_image'], $user);
            }

            // Handle published_at
            if ($data['status'] === 'published' && $blog->status !== 'published' && empty($data['published_at'])) {
                $data['published_at'] = now();
            }

            $blog->update($data);

            Log::info('Blog updated successfully', ['blog_id' => $blog->id, 'user_id' => Auth::id()]);

            return $blog->fresh();
        } catch (Exception $e) {
            Log::error('Error updating blog: ' . $e->getMessage(), [
                'blog_id' => $blog->id,
                'data' => $data,
                'user_id' => Auth::id()
            ]);
            return null;
        }
    }

    /**
     * Delete a blog
     *
     * @param Blog $blog
     * @return bool
     */
    public function deleteBlog(Blog $blog)
    {
        try {
            // Delete featured image
            if ($blog->featured_image) {
                $this->deleteFeaturedImage($blog->featured_image);
            }

            $blogId = $blog->id;
            $blog->delete();

            Log::info('Blog deleted successfully', ['blog_id' => $blogId, 'user_id' => Auth::id()]);

            return true;
        } catch (Exception $e) {
            Log::error('Error deleting blog: ' . $e->getMessage(), [
                'blog_id' => $blog->id,
                'user_id' => Auth::id()
            ]);
            return false;
        }
    }

    /**
     * Get user's blogs
     *
     * @param int|null $userId
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUserBlogs($userId = null, array $filters = [])
    {
        $filters['user_id'] = $userId ?? Auth::id();
        return $this->getBlogsWithFilters($filters);
    }

    /**
     * Get published blogs for public viewing
     *
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPublishedBlogs(array $filters = [])
    {
        $filters['status'] = 'published';
        return $this->getBlogsWithFilters($filters);
    }

    /**
     * Get featured blogs
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFeaturedBlogs(int $limit = 5)
    {
        try {
            return Blog::with('user:id,name,email')
                      ->published()
                      ->featured()
                      ->orderBy('published_at', 'desc')
                      ->limit($limit)
                      ->get();
        } catch (Exception $e) {
            Log::error('Error fetching featured blogs: ' . $e->getMessage());
            return collect();
        }
    }

    /**
     * Process featured image upload
     *
     * @param UploadedFile $file
     * @param User $user
     * @return string
     */
    private function processFeaturedImage(UploadedFile $file, User $user)
    {
        try {
            // Create directory if it doesn't exist
            $blogDir = $user->name . '/blogs/featured_images';
            Storage::disk('public')->makeDirectory($blogDir);

            // Generate unique filename
            $filename = 'featured_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $fullPath = $blogDir . '/' . $filename;

            // Process image with Intervention Image
            $image = Image::make($file->getPathname());
            
            // Resize to standard blog featured image size (maintain aspect ratio)
            $image->fit(1200, 630, function ($constraint) {
                $constraint->upsize(); // Prevent upsizing
            });

            // Save the processed image
            Storage::disk('public')->put($fullPath, $image->encode($file->getClientOriginalExtension(), 85));

            Log::info('Featured image processed successfully', [
                'user_id' => $user->id,
                'path' => $fullPath,
                'original_size' => $file->getSize()
            ]);

            return $fullPath;
        } catch (Exception $e) {
            Log::error('Error processing featured image: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Delete featured image
     *
     * @param string $imagePath
     * @return void
     */
    private function deleteFeaturedImage(string $imagePath)
    {
        try {
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
                Log::info('Featured image deleted successfully', ['path' => $imagePath]);
            }
        } catch (Exception $e) {
            Log::error('Error deleting featured image: ' . $e->getMessage(), ['path' => $imagePath]);
        }
    }

    /**
     * Generate blog statistics for a user
     *
     * @param int|null $userId
     * @return array
     */
    public function getBlogStatistics($userId = null)
    {
        try {
            $userId = $userId ?? Auth::id();

            $stats = [
                'total_blogs' => Blog::where('user_id', $userId)->count(),
                'published_blogs' => Blog::where('user_id', $userId)->published()->count(),
                'draft_blogs' => Blog::where('user_id', $userId)->draft()->count(),
                'total_views' => Blog::where('user_id', $userId)->sum('views_count'),
                'featured_blogs' => Blog::where('user_id', $userId)->featured()->count(),
            ];

            return $stats;
        } catch (Exception $e) {
            Log::error('Error generating blog statistics: ' . $e->getMessage(), ['user_id' => $userId]);
            return [
                'total_blogs' => 0,
                'published_blogs' => 0,
                'draft_blogs' => 0,
                'total_views' => 0,
                'featured_blogs' => 0,
            ];
        }
    }
}
