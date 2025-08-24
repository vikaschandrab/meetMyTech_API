<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Blog;
use App\Models\User;
use App\Services\BlogService;

echo "=== Blog Statistics Debug ===\n";

// Check total blogs
echo "Total blogs in system: " . Blog::count() . "\n";

// Check users and their blogs
$users = User::all();
foreach ($users as $user) {
    $blogCount = Blog::where('user_id', $user->id)->count();
    echo "User: {$user->name} (ID: {$user->id}) - Blogs: {$blogCount}\n";
    
    if ($blogCount > 0) {
        $blogs = Blog::where('user_id', $user->id)->get();
        foreach ($blogs as $blog) {
            echo "  - {$blog->title} (Status: {$blog->status})\n";
        }
    }
}

// Test BlogService
echo "\n=== Testing BlogService ===\n";
$blogService = new BlogService();

// Test with first user that has blogs
$userWithBlogs = User::whereHas('blogs')->first();
if ($userWithBlogs) {
    echo "Testing with user: {$userWithBlogs->name} (ID: {$userWithBlogs->id})\n";
    $stats = $blogService->getBlogStatistics($userWithBlogs->id);
    echo "Statistics: " . json_encode($stats, JSON_PRETTY_PRINT) . "\n";
} else {
    echo "No users with blogs found\n";
}
