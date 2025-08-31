<?php

// Simple test script to verify redirect logic
require_once 'bootstrap/app.php';

use App\Services\RedirectService;
use Illuminate\Http\Request;

// Create a mock blog object
$blog = (object) [
    'user' => (object) [
        'name' => 'John Doe',
        'slug' => 'john-doe'
    ]
];

// Test different referrer scenarios
$testCases = [
    [
        'referrer' => 'http://127.0.0.1:8000/',
        'expected_label' => 'Back to Home'
    ],
    [
        'referrer' => 'http://127.0.0.1:8000/all-blogs',
        'expected_label' => 'Back to All Blogs'
    ],
    [
        'referrer' => 'http://john.meetmytech.com/',
        'expected_label' => "Back to John's Profile"
    ],
    [
        'referrer' => 'http://127.0.0.1:8000/john-doe',
        'expected_label' => "Back to John Doe's Profile"
    ],
    [
        'referrer' => null,
        'expected_label' => 'Back to All Blogs'
    ]
];

echo "Testing RedirectService::getBlogBackUrl\n";
echo "========================================\n\n";

foreach ($testCases as $i => $testCase) {
    echo "Test " . ($i + 1) . ":\n";
    echo "Referrer: " . ($testCase['referrer'] ?: 'null') . "\n";

    // Create a mock request
    $request = new Request();
    if ($testCase['referrer']) {
        $request->headers->set('referer', $testCase['referrer']);
    }

    $result = RedirectService::getBlogBackUrl($request, $blog);

    echo "Result URL: " . $result['url'] . "\n";
    echo "Result Label: " . $result['label'] . "\n";
    echo "Expected Label: " . $testCase['expected_label'] . "\n";
    echo "✓ " . ($result['label'] === $testCase['expected_label'] ? 'PASS' : 'FAIL') . "\n";
    echo "\n";
}

echo "Test completed!\n";
