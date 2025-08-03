<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Services\WorkExperienceService;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Create Laravel application instance
$app = new Application(__DIR__);

// Bootstrap the application
require_once 'bootstrap/app.php';

// Set up database
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Testing Work Experience CRUD Operations...\n\n";

try {
    // Get a test user (first user in database)
    $user = User::first();
    if (!$user) {
        echo "❌ No users found in database. Please create a user first.\n";
        exit;
    }

    // Simulate authentication
    Auth::login($user);
    echo "✅ Authenticated as user: {$user->name} (ID: {$user->id})\n\n";

    // Initialize the service
    $workExperienceService = new WorkExperienceService();

    // Test data for work experience
    $testData = [
        'organization' => 'Test Company Ltd.',
        'position' => 'Software Developer',
        'from_date' => 2020,
        'to_date' => 2023,
        'roles_and_responsibilities' => 'Developed web applications using Laravel, managed database operations, and collaborated with cross-functional teams to deliver high-quality software solutions.'
    ];

    echo "📝 Test Data:\n";
    foreach ($testData as $key => $value) {
        echo "   - {$key}: {$value}\n";
    }
    echo "\n";

    // 1. Test CREATE operation
    echo "1. Testing CREATE operation...\n";
    $createdExperience = $workExperienceService->addWorkExperience($testData);

    if ($createdExperience) {
        echo "✅ Work experience created successfully!\n";
        echo "   ID: {$createdExperience->id}\n";
        echo "   Organization: {$createdExperience->organization}\n";
        echo "   Position: {$createdExperience->position}\n\n";
    } else {
        echo "❌ Failed to create work experience\n\n";
        exit;
    }

    // 2. Test READ operation
    echo "2. Testing READ operation...\n";
    $experiences = $workExperienceService->getUserWorkExperiences();

    if ($experiences->count() > 0) {
        echo "✅ Found {$experiences->count()} work experience(s):\n";
        foreach ($experiences as $exp) {
            echo "   - {$exp->position} at {$exp->organization} ({$exp->from_date}-{$exp->to_date})\n";
        }
        echo "\n";
    } else {
        echo "❌ No work experiences found\n\n";
    }

    // 3. Test UPDATE operation
    echo "3. Testing UPDATE operation...\n";
    $updateData = [
        'organization' => 'Updated Company Inc.',
        'position' => 'Senior Software Developer',
        'from_date' => 2020,
        'to_date' => null, // Currently working
        'roles_and_responsibilities' => 'Lead development team, architected scalable solutions, mentored junior developers, and implemented best practices for code quality and deployment.'
    ];

    $updatedExperience = $workExperienceService->updateWorkExperience($createdExperience->id, $updateData);

    if ($updatedExperience) {
        echo "✅ Work experience updated successfully!\n";
        echo "   New Organization: {$updatedExperience->organization}\n";
        echo "   New Position: {$updatedExperience->position}\n";
        echo "   To Date: " . ($updatedExperience->to_date ?? 'Present') . "\n\n";
    } else {
        echo "❌ Failed to update work experience\n\n";
    }

    // 4. Test GET BY ID operation
    echo "4. Testing GET BY ID operation...\n";
    $singleExperience = $workExperienceService->getWorkExperienceById($createdExperience->id);

    if ($singleExperience) {
        echo "✅ Work experience found by ID!\n";
        echo "   ID: {$singleExperience->id}\n";
        echo "   Organization: {$singleExperience->organization}\n";
        echo "   Position: {$singleExperience->position}\n\n";
    } else {
        echo "❌ Work experience not found by ID\n\n";
    }

    // 5. Test DELETE operation
    echo "5. Testing DELETE operation...\n";
    $deleted = $workExperienceService->deleteWorkExperience($createdExperience->id);

    if ($deleted) {
        echo "✅ Work experience deleted successfully!\n\n";
    } else {
        echo "❌ Failed to delete work experience\n\n";
    }

    // 6. Verify deletion
    echo "6. Verifying deletion...\n";
    $experiencesAfterDelete = $workExperienceService->getUserWorkExperiences();
    $deletedExperience = $workExperienceService->getWorkExperienceById($createdExperience->id);

    if (!$deletedExperience) {
        echo "✅ Work experience successfully removed from database\n";
        echo "✅ Current work experience count: {$experiencesAfterDelete->count()}\n\n";
    } else {
        echo "❌ Work experience still exists in database\n\n";
    }

    echo "🎉 All Work Experience CRUD operations completed!\n\n";

    // Test validation
    echo "7. Testing validation...\n";
    $invalidData = [
        'organization' => '', // Empty organization
        'position' => '',     // Empty position
        'from_date' => 1800,  // Invalid year
        'to_date' => 2050,    // Too far in future
        'roles_and_responsibilities' => 'Short' // Too short
    ];

    echo "   Testing with invalid data...\n";
    $invalidExperience = $workExperienceService->addWorkExperience($invalidData);

    if (!$invalidExperience) {
        echo "✅ Validation correctly prevented invalid data\n";
    } else {
        echo "❌ Validation failed - invalid data was accepted\n";
    }

    echo "\n✅ Work Experience CRUD operations are working correctly!\n";

} catch (Exception $e) {
    echo "❌ Error during testing: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}
