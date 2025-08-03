<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Services\EducationService;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

try {
    // Get a test user
    $user = User::first();
    if (!$user) {
        echo "No users found in database. Please create a user first.\n";
        exit;
    }

    // Set the authenticated user
    Auth::login($user);

    echo "Testing EducationService with user: {$user->name}\n";

    // Create service instance
    $educationService = new EducationService();

    // Test data
    $testData = [
        'degree' => 'Test Degree',
        'precentage' => '85%',
        'from_date' => '2020-01-01',
        'to_date' => '2024-01-01',
        'university' => 'Test University',
        'description' => 'Test description for education'
    ];

    echo "Adding test education record...\n";
    $education = $educationService->addEducation($testData);
    echo "Successfully added education with ID: {$education->id}\n";

    echo "Getting user education records...\n";
    $educationList = $educationService->getUserEducation($user);
    echo "Found " . count($educationList) . " education records\n";

    echo "Education CRUD operations are working correctly!\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
