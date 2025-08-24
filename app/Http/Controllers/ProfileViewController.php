<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;
use Illuminate\Support\Facades\Log;

class ProfileViewController extends Controller
{
    /**
     * Display user profile by slug
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        // Debug: Log the slug being requested
        Log::info("Profile requested for slug: " . $slug);

        try {
            // Find user by slug
            $user = User::where('slug', $slug)
                       ->with([
                           'detail',
                           'workExperiences',
                           'userActivity',
                           'UserProfessionalSkill',
                           'EducationDetail',
                           'SiteSettings'
                       ])
                       ->firstOrFail();

            // Debug: Log user found
            Log::info("User found: " . $user->name . " (ID: " . $user->id . ")");

            // Get user's published blogs (latest 3 for homepage)
            $blogs = Blog::where('user_id', $user->id)
                        ->where('status', 'published')
                        ->orderBy('created_at', 'desc')
                        ->with(['category', 'tags'])
                        ->limit(3)
                        ->get();

            // Debug: Log blog count
            Log::info("Blogs found for user: " . $blogs->count());

            // Add read time calculation if not already present
            $blogs = $blogs->map(function ($blog) {
                if (!$blog->read_time) {
                    $wordCount = str_word_count(strip_tags($blog->content));
                    $blog->read_time = max(1, ceil($wordCount / 200)); // Average reading speed
                }
                return $blog;
            });

            // Randomly select design template
            $designs = ['Vikas.Design_1_restructured', 'Vikas.Design_2_restructured'];
            $randomDesign = $designs[array_rand($designs)];

            // Debug: Log selected design
            Log::info("Selected design template: " . $randomDesign);

            // Prepare view data
            $viewData = [
                'user' => $user,
                'blogs' => $blogs,
                'skills' => $this->getUserSkills($user),
                'education' => $this->getUserEducation($user),
                'workExperience' => $this->getUserWorkExperience($user),
                'activities' => $this->getUserActivities($user),
                'siteSettings' => $this->getUserSiteSettings($user),
                'userDetails' => $this->getUserDetails($user)
            ];

            return view($randomDesign, $viewData);

        } catch (\Exception $e) {
            Log::error('Failed to load user profile: ' . $e->getMessage(), [
                'exception' => $e,
                'slug' => $slug,
                'action' => 'profile_load'
            ]);

            abort(404, 'Profile not found');
        }
    }

    /**
     * Display all blogs for a specific user
     *
     * @param string $slug
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function blogs($slug, Request $request)
    {
        try {
            // Find user by slug
            $user = User::where('slug', $slug)->firstOrFail();

            $query = Blog::where('user_id', $user->id)
                        ->where('status', 'published')
                        ->with(['category', 'tags'])
                        ->orderBy('created_at', 'desc');

            // Add search functionality
            if ($request->has('search') && $request->search) {
                $searchTerm = $request->search;
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('title', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('content', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('excerpt', 'LIKE', "%{$searchTerm}%");
                });
            }

            // Add category filter
            if ($request->has('category') && $request->category) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('slug', $request->category);
                });
            }

            $blogs = $query->paginate(9);

            // Add read time calculation
            $blogs->getCollection()->transform(function ($blog) {
                if (!$blog->read_time) {
                    $wordCount = str_word_count(strip_tags($blog->content));
                    $blog->read_time = max(1, ceil($wordCount / 200));
                }
                return $blog;
            });

            return view('Vikas.pages.blogs', compact('blogs', 'user'));

        } catch (\Exception $e) {
            Log::error('Failed to load user blogs page: ' . $e->getMessage(), [
                'exception' => $e,
                'slug' => $slug,
                'action' => 'user_blogs_page_load'
            ]);

            abort(404, 'User not found');
        }
    }

    /**
     * Display a specific blog post by user
     *
     * @param string $userSlug
     * @param string $blogSlug
     * @return \Illuminate\View\View
     */
    public function showBlog($userSlug, $blogSlug)
    {
        try {
            // Find user by slug
            $user = User::where('slug', $userSlug)->firstOrFail();

            // Find blog belonging to this user
            $blog = Blog::where('slug', $blogSlug)
                       ->orWhere('id', $blogSlug)
                       ->where('user_id', $user->id)
                       ->where('status', 'published')
                       ->with(['category', 'tags'])
                       ->firstOrFail();

            // Get related blogs from the same user
            $relatedBlogs = Blog::where('user_id', $user->id)
                               ->where('status', 'published')
                               ->where('id', '!=', $blog->id)
                               ->when($blog->category, function ($query) use ($blog) {
                                   return $query->where('category_id', $blog->category->id);
                               })
                               ->orderBy('created_at', 'desc')
                               ->limit(3)
                               ->get();

            return view('Vikas.pages.blog-detail', compact('blog', 'relatedBlogs', 'user'));

        } catch (\Exception $e) {
            Log::error('Failed to load user blog detail: ' . $e->getMessage(), [
                'exception' => $e,
                'userSlug' => $userSlug,
                'blogSlug' => $blogSlug,
                'action' => 'user_blog_detail_load'
            ]);

            abort(404, 'Blog post not found');
        }
    }

    /**
     * Get user's skills data
     *
     * @param User $user
     * @return array
     */
    private function getUserSkills($user)
    {
        if ($user->UserProfessionalSkill && $user->UserProfessionalSkill->count() > 0) {
            return $user->UserProfessionalSkill
                ->sortByDesc('id')
                ->values()
                ->map(function ($skill) {
                    return [
                        'name' => $skill->skill_name,
                        'percentage' => $skill->skill_percentage
                    ];
                })->toArray();
        }

        // Return empty array if no skills found
        return [];
    }

    /**
     * Get user's education data
     *
     * @param User $user
     * @return array
     */
    private function getUserEducation($user)
    {
        if ($user->EducationDetail && $user->EducationDetail->count() > 0) {
            return $user->EducationDetail
                ->sortByDesc('id')
                ->values()
                ->map(function ($education) {
                    return [
                        'degree' => $education->degree,
                        'year' => $education->start_year . ' - ' . ($education->end_year ?: 'Present'),
                        'institution' => $education->institution,
                        'description' => $education->description
                    ];
                })->toArray();
        }

        return [];
    }

    /**
     * Get user's work experience data
     *
     * @param User $user
     * @return array
     */
    private function getUserWorkExperience($user)
    {
        if ($user->workExperiences && $user->workExperiences->count() > 0) {
            return $user->workExperiences
                ->sortByDesc('id')
                ->values()
                ->map(function ($experience) {
                    return [
                        'position' => $experience->position,
                        'period' => $experience->start_date . ' - ' . ($experience->end_date ?: 'Present'),
                        'company' => $experience->company,
                        'description' => $experience->description,
                        'achievements' => $experience->achievements ? explode("\n", $experience->achievements) : []
                    ];
                })->toArray();
        }

        return [];
    }

    /**
     * Get user's activities data
     *
     * @param User $user
     * @return array
     */
    private function getUserActivities($user)
    {
        if ($user->userActivity && $user->userActivity->count() > 0) {
            return $user->userActivity->toArray();
        }

        return [];
    }

    /**
     * Get user's site settings
     *
     * @param User $user
     * @return array
     */
    private function getUserSiteSettings($user)
    {
        if ($user->SiteSettings && $user->SiteSettings->count() > 0) {
            return $user->SiteSettings->pluck('value', 'key')->toArray();
        }

        return [];
    }

    /**
     * Get user's detail data from user_details table
     *
     * @param User $user
     * @return array
     */
    private function getUserDetails($user)
    {
        if ($user->detail) {
            return [
                'id' => $user->detail->id,
                'bio' => $user->detail->bio ?? '',
                'profile_image' => $user->detail->profile_image ?? '',
                'resume_file' => $user->detail->resume_file ?? '',
                'portfolio_url' => $user->detail->portfolio_url ?? '',
                'github_url' => $user->detail->github_url ?? '',
                'linkedin_url' => $user->detail->linkedin_url ?? '',
                'twitter_url' => $user->detail->twitter_url ?? '',
                'facebook_url' => $user->detail->facebook_url ?? '',
                'instagram_url' => $user->detail->instagram_url ?? '',
                'whatsapp_number' => $user->detail->whatsapp_number ?? '',
                'phone' => $user->detail->phone ?? '',
                'address' => $user->detail->address ?? '',
                'city' => $user->detail->city ?? '',
                'state' => $user->detail->state ?? '',
                'country' => $user->detail->country ?? '',
                'postal_code' => $user->detail->postal_code ?? '',
                'date_of_birth' => $user->detail->date_of_birth ?? null,
                'years_of_experience' => $user->detail->years_of_experience ?? 0,
                'hourly_rate' => $user->detail->hourly_rate ?? null,
                'availability' => $user->detail->availability ?? '',
                'languages' => $user->detail->languages ?? '',
                'certifications' => $user->detail->certifications ?? '',
                'awards' => $user->detail->awards ?? '',
                'interests' => $user->detail->interests ?? '',
                'created_at' => $user->detail->created_at,
                'updated_at' => $user->detail->updated_at
            ];
        }

        return [];
    }
}
