<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

// Test route to check user slugs
Route::get('/test-users', function () {
    $users = User::select('id', 'name', 'slug')->get();

    $output = '<h1>Users and their slugs:</h1>';
    foreach ($users as $user) {
        $output .= '<p><strong>ID:</strong> ' . $user->id . ' | <strong>Name:</strong> ' . $user->name . ' | <strong>Slug:</strong> ' . $user->slug . '</p>';
        $output .= '<p><a href="/' . $user->slug . '">Test Link: /' . $user->slug . '</a></p><hr>';
    }

    return $output;
});

// Test route to debug specific slug
Route::get('/test-slug/{slug}', function ($slug) {
    $user = User::where('slug', $slug)->first();

    if ($user) {
        return '<h1>User Found!</h1><p><strong>Name:</strong> ' . $user->name . '</p><p><strong>Slug:</strong> ' . $user->slug . '</p><p><a href="/' . $slug . '">Go to Profile</a></p>';
    } else {
        return '<h1>User NOT Found</h1><p>No user with slug: ' . $slug . '</p>';
    }
});

?>
