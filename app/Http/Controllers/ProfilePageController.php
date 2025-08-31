<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use App\Models\Blog;
use Illuminate\Support\Facades\Log;
use App\Services\BlogService;
use App\Services\RedirectService;

class ProfilePageController extends Controller
{
    protected $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function show($slug)
    {
        $UserDetails = User::with(['SiteSettings', 'userActivity', 'detail', 'userProfessionalSkills'])
            ->where('slug', $slug)
            ->first();

        if (!$UserDetails) {
            abort(404, 'User not found');
        }

        // Check if user account is active
        if ($UserDetails->status !== 'active') {
            abort(403, 'This profile is not available. The user account is inactive.');
        }

        // Get the first site setting record (assuming one per user)
        $siteSettings = $UserDetails->SiteSettings->first();

        // Add site settings as properties to the user object for backward compatibility
        if ($siteSettings) {
            foreach ($siteSettings->getAttributes() as $key => $value) {
                if ($key !== 'id' && $key !== 'user_id' && $key !== 'created_at' && $key !== 'updated_at') {
                    $UserDetails->$key = $value;
                }
            }
        }

        // Get all user activity records (handling multiple records)
        $userActivities = $UserDetails->userActivity;

        // Add user activities as properties to the user object for backward compatibility
        if ($userActivities && $userActivities->count() > 0) {
            // If multiple records, create arrays for each field
            $activityData = [];
            foreach ($userActivities as $index => $userActivity) {
                foreach ($userActivity->getAttributes() as $key => $value) {
                    if ($key !== 'id' && $key !== 'user_id' && $key !== 'created_at' && $key !== 'updated_at') {
                        if (!isset($activityData[$key])) {
                            $activityData[$key] = [];
                        }
                        $activityData[$key][] = $value;
                    }
                }
            }

            // Add activity data to UserDetails
            foreach ($activityData as $key => $values) {
                $UserDetails->$key = $values;
            }
        }

        // Get user detail record (hasOne relationship)
        $userDetail = $UserDetails->detail;

        // Add user detail as properties to the user object for backward compatibility
        if ($userDetail) {
            foreach ($userDetail->getAttributes() as $key => $value) {
                if ($key !== 'id' && $key !== 'user_id' && $key !== 'created_at' && $key !== 'updated_at') {
                    $UserDetails->$key = $value;
                }
            }
        }

        // Get user professional skill record (hasMany relationship)
        $userProfessionalSkill = $UserDetails->userProfessionalSkills;

        // Add user professional skill as properties to the user object for backward compatibility
        if ($userProfessionalSkill) {
            // Check if it's a collection (hasMany) or single model (hasOne)
            if ($userProfessionalSkill instanceof \Illuminate\Database\Eloquent\Collection) {
                // If it's a collection, get the first record
                $skillRecord = $userProfessionalSkill->first();
                if ($skillRecord) {
                    foreach ($skillRecord->getAttributes() as $key => $value) {
                        if ($key !== 'id' && $key !== 'user_id' && $key !== 'created_at' && $key !== 'updated_at') {
                            $UserDetails->$key = $value;
                        }
                    }
                }
            } else {
                // If it's a single model instance
                foreach ($userProfessionalSkill->getAttributes() as $key => $value) {
                    if ($key !== 'id' && $key !== 'user_id' && $key !== 'created_at' && $key !== 'updated_at') {
                        $UserDetails->$key = $value;
                    }
                }
            }
        }

        $EducationDetails = $UserDetails->educationDetails()->orderBy('created_at', 'desc')->get();

        $WorkExperiences = $UserDetails->WorkExperiences()
            ->orderByRaw('to_date IS NULL DESC')
            ->orderBy('created_at', 'desc')
            ->get();

        $blogs = $UserDetails->blogs()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->get();

        return view("ProfileWebsite.Design_1", ['UserDetails' => $UserDetails, 'EducationDetails' => $EducationDetails, 'WorkExperiences' => $WorkExperiences, 'blogs' => $blogs]);

    }

    /**
     * Display the specified blog for public viewing
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function publicShow(string $slug, Request $request)
    {
        try {
            $blog = $this->blogService->getBlogBySlug($slug, true); // Increment views

            if (!$blog || $blog->status !== 'published') {
                abort(404, 'Blog not found.');
            }

            // Add authorSlug to the main blog object
            $blog->load('user:id,name,email,slug,status');
            $blog->authorSlug = $blog->user->slug;

            // Check if the blog author's account is active
            if ($blog->user->status !== 'active') {
                abort(404, 'Blog not available. Author account is inactive.');
            }

            // Get smart back URL based on referrer
            $backInfo = RedirectService::getBlogBackUrl($request, $blog);

            // Get related blogs by same author (excluding current blog)
            $relatedBlogs = Blog::with('user:id,name,email,slug,status')
                ->where('user_id', $blog->user_id)
                ->where('id', '!=', $blog->id)
                ->where('status', 'published')
                ->whereHas('user', function($query) {
                    $query->where('status', 'active');
                })
                ->orderBy('published_at', 'desc')
                ->limit(4)
                ->get()
                ->map(function($blog) {
                    $blog->authorSlug = $blog->user->slug;
                    return $blog;
                });

            // Load all comments for this blog
            $comments = \App\Models\Comment::where('blog_id', $blog->id)->orderBy('created_at')->get();

            return view('public.blogs.show', compact('blog', 'relatedBlogs', 'comments', 'backInfo'));
        } catch (Exception $e) {
            Log::error('Error showing public blog: ' . $e->getMessage(), ['slug' => $slug]);
            abort(404, 'Blog not found.');
        }
    }

    /**
     * Store a new comment for a blog
     *
     * @param Request $request
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeComment(Request $request, string $slug)
    {
        try {
            // Validate the request including reCAPTCHA
            $request->validate([
                'user_name' => 'required|string|max:255',
                'message' => 'required|string|max:1000',
                'g-recaptcha-response' => 'required|captcha',
            ], [
                'user_name.required' => 'Please enter your name.',
                'user_name.max' => 'Name must not exceed 255 characters.',
                'message.required' => 'Please enter your comment.',
                'message.max' => 'Comment must not exceed 1000 characters.',
                'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
                'g-recaptcha-response.captcha' => 'reCAPTCHA verification failed, please try again.',
            ]);

            // Find the blog
            $blog = $this->blogService->getBlogBySlug($slug, false);

            if (!$blog) {
                Log::warning('Blog not found for comment submission', ['slug' => $slug]);
                return redirect()->back()->with('error', 'Blog not found.');
            }

            if ($blog->status !== 'published') {
                Log::warning('Attempted to comment on unpublished blog', ['slug' => $slug, 'status' => $blog->status]);
                return redirect()->back()->with('error', 'Blog not available for comments.');
            }

            // Load the user relationship to check status
            $blog->load('user');

            if (!$blog->user) {
                Log::error('Blog has no associated user', ['blog_id' => $blog->id, 'slug' => $slug]);
                return redirect()->back()->with('error', 'Unable to comment. Blog author information not available.');
            }

            // Check if the blog author's account is active (temporarily disabled for debugging)
            // if ($blog->user->status !== 'active') {
            //     Log::warning('Attempted to comment on blog with inactive author', [
            //         'slug' => $slug,
            //         'author_id' => $blog->user->id,
            //         'author_status' => $blog->user->status
            //     ]);
            //     return redirect()->back()->with('error', 'Unable to comment. Blog author account is not active.');
            // }

            Log::info('Blog author status check', [
                'slug' => $slug,
                'author_id' => $blog->user->id,
                'author_status' => $blog->user->status ?? 'status_field_missing'
            ]);

            // Create the comment
            $comment = \App\Models\Comment::create([
                'blog_id' => $blog->id,
                'user_name' => trim($request->user_name),
                'message' => trim($request->message),
            ]);

            Log::info('Comment created successfully', [
                'comment_id' => $comment->id,
                'blog_slug' => $slug,
                'user_name' => $request->user_name
            ]);

            return redirect()->back()->with('success', 'Your comment has been posted successfully!');

        } catch (Exception $e) {
            Log::error('Error storing comment: ' . $e->getMessage(), [
                'slug' => $slug,
                'user_name' => $request->user_name ?? 'unknown',
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Unable to post comment. Please try again.');
        }
    }
}
