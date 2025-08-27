<?php

namespace App\Services;

use App\Models\User;
use App\Models\Blog;
use App\Models\UserActivity;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class AdminService
{
    /**
     * Get admin dashboard statistics
     */
    public function getDashboardStats(): array
    {
        return [
            'total_users' => User::where('user_type', 'user')->count(),
            'total_blogs' => Blog::count(),
            'recent_users' => User::where('user_type', 'user')->latest()->take(5)->get(),
            'recent_blogs' => Blog::latest()->take(5)->get(),
            'user_activities' => UserActivity::with('user')->latest()->take(10)->get(),
        ];
    }

    /**
     * Get paginated users with activities
     */
    public function getUsers(int $perPage = 20): LengthAwarePaginator
    {
        return User::where('user_type', 'user')
            ->with(['activities' => function($query) {
                $query->latest()->take(3);
            }])
            ->paginate($perPage);
    }

    /**
     * Get user details with relationships
     */
    public function getUserDetails(int $userId): User
    {
        return User::with([
            'userDetail',
            'educationDetails',
            'workExperiences',
            'userProfessionalSkills',
            'activities'
        ])->findOrFail($userId);
    }

    /**
     * Update user status
     */
    public function updateUserStatus(int $userId, string $status): bool
    {
        $user = User::findOrFail($userId);
        $user->status = $status;
        
        return $user->save();
    }

    /**
     * Get paginated blogs
     */
    public function getBlogs(int $perPage = 20): LengthAwarePaginator
    {
        return Blog::latest()->paginate($perPage);
    }

    /**
     * Create new user with generated password
     */
    public function createUser(array $userData): array
    {
        $autoPassword = $this->generateSecurePassword();
        $slug = $this->generateUniqueSlug($userData['name']);

        $user = User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => Hash::make($autoPassword),
            'slug' => $slug,
            'user_type' => 'user',
            'status' => 'active',
        ]);

        return [
            'user' => $user,
            'password' => $autoPassword
        ];
    }

    /**
     * Generate secure random password
     */
    private function generateSecurePassword(): string
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        return substr(str_shuffle($chars), 0, 8);
    }

    /**
     * Generate unique slug from name
     */
    private function generateUniqueSlug(string $name): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;

        while (User::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
