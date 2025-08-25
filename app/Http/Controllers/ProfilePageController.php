<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use App\Models\Blog;
use Illuminate\Support\Facades\Log;
use App\Services\BlogService;

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
    public function publicShow(string $slug)
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

            return view('public.blogs.show', compact('blog', 'relatedBlogs'));
        } catch (Exception $e) {
            Log::error('Error showing public blog: ' . $e->getMessage(), ['slug' => $slug]);
            abort(404, 'Blog not found.');
        }
    }
}
