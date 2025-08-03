<?php

namespace App\Services;

use App\Models\User;
use App\Models\Blog;
use App\Models\WorkExperience;
use App\Models\EducationDetail;
use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardService
{
    /**
     * Get dashboard statistics
     */
    public function getDashboardStats()
    {
        $user = Auth::user();
        
        return [
            'total_blogs' => $this->getTotalBlogs(),
            'total_experiences' => $this->getTotalExperiences(),
            'total_education' => $this->getTotalEducation(),
            'total_activities' => $this->getTotalActivities(),
            'recent_blogs' => $this->getRecentBlogs(),
            'profile_completion' => $this->getProfileCompletion(),
            'monthly_blog_stats' => $this->getMonthlyBlogStats(),
            'recent_activity' => $this->getRecentActivity()
        ];
    }

    /**
     * Get total blogs count
     */
    private function getTotalBlogs()
    {
        return Blog::where('user_id', Auth::id())->count();
    }

    /**
     * Get total work experiences count
     */
    private function getTotalExperiences()
    {
        return WorkExperience::where('user_id', Auth::id())->count();
    }

    /**
     * Get total education records count
     */
    private function getTotalEducation()
    {
        return EducationDetail::where('user_id', Auth::id())->count();
    }

    /**
     * Get total activities count
     */
    private function getTotalActivities()
    {
        return UserActivity::where('user_id', Auth::id())->count();
    }

    /**
     * Get recent blogs
     */
    private function getRecentBlogs($limit = 5)
    {
        return Blog::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get(['id', 'title', 'slug', 'status', 'created_at']);
    }

    /**
     * Calculate profile completion percentage
     */
    private function getProfileCompletion()
    {
        $user = Auth::user();
        $completion = 0;
        $totalFields = 8;

        // Check basic profile fields
        if ($user->name) $completion++;
        if ($user->email) $completion++;
        if ($user->profilePic) $completion++;
        
        // Check if user has about information
        if ($user->userDetail && $user->userDetail->about) $completion++;
        
        // Check if user has activities
        if ($this->getTotalActivities() > 0) $completion++;
        
        // Check if user has education
        if ($this->getTotalEducation() > 0) $completion++;
        
        // Check if user has work experience
        if ($this->getTotalExperiences() > 0) $completion++;
        
        // Check if user has blogs
        if ($this->getTotalBlogs() > 0) $completion++;

        return round(($completion / $totalFields) * 100);
    }

    /**
     * Get monthly blog statistics for the last 12 months
     */
    private function getMonthlyBlogStats()
    {
        $stats = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $count = Blog::where('user_id', Auth::id())
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            
            $stats[] = [
                'month' => $date->format('M'),
                'count' => $count
            ];
        }
        
        return $stats;
    }

    /**
     * Get recent activity data
     */
    private function getRecentActivity($limit = 10)
    {
        $activities = collect();
        
        // Recent blogs
        $recentBlogs = Blog::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($blog) {
                return [
                    'type' => 'blog',
                    'title' => 'Published blog: ' . $blog->title,
                    'date' => $blog->created_at,
                    'icon' => 'edit-3',
                    'color' => 'primary'
                ];
            });

        // Recent work experiences
        $recentExperiences = WorkExperience::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($exp) {
                return [
                    'type' => 'experience',
                    'title' => 'Added experience: ' . $exp->job_title . ' at ' . $exp->company_name,
                    'date' => $exp->created_at,
                    'icon' => 'briefcase',
                    'color' => 'success'
                ];
            });

        return $activities->merge($recentBlogs)
            ->merge($recentExperiences)
            ->sortByDesc('date')
            ->take($limit)
            ->values();
    }

    /**
     * Get browser usage statistics (mock data for demo)
     */
    public function getBrowserStats()
    {
        return [
            ['name' => 'Chrome', 'value' => 4306, 'color' => '#007bff'],
            ['name' => 'Firefox', 'value' => 3801, 'color' => '#ffc107'],
            ['name' => 'Safari', 'value' => 1689, 'color' => '#dc3545']
        ];
    }

    /**
     * Get world map markers (mock data for demo)
     */
    public function getWorldMapData()
    {
        return [
            ['coords' => [31.230391, 121.473701], 'name' => 'Shanghai'],
            ['coords' => [28.704060, 77.102493], 'name' => 'Delhi'],
            ['coords' => [6.524379, 3.379206], 'name' => 'Lagos'],
            ['coords' => [35.689487, 139.691711], 'name' => 'Tokyo'],
            ['coords' => [23.129110, 113.264381], 'name' => 'Guangzhou'],
            ['coords' => [40.7127837, -74.0059413], 'name' => 'New York'],
            ['coords' => [34.052235, -118.243683], 'name' => 'Los Angeles'],
            ['coords' => [41.878113, -87.629799], 'name' => 'Chicago'],
            ['coords' => [51.507351, -0.127758], 'name' => 'London'],
            ['coords' => [40.416775, -3.703790], 'name' => 'Madrid']
        ];
    }
}
