<?php
// Quick version check script
require_once 'vendor/autoload.php';

echo "PHP Version: " . phpversion() . "\n";

// Check Laravel version from composer.lock
$composerLock = json_decode(file_get_contents('composer.lock'), true);
foreach ($composerLock['packages'] as $package) {
    if ($package['name'] === 'laravel/framework') {
        echo "Laravel Version: " . $package['version'] . "\n";
        break;
    }
}

// Check if Laravel 10/11 compatible
$phpVersion = phpversion();
echo "PHP Version for Laravel compatibility: " . $phpVersion . "\n";

if (version_compare($phpVersion, '8.1.0', '>=')) {
    echo "✅ PHP 8.1+ detected - Compatible with Laravel 10\n";
    if (version_compare($phpVersion, '8.2.0', '>=')) {
        echo "✅ PHP 8.2+ detected - Compatible with Laravel 11\n";
    }
} else {
    echo "❌ Need PHP 8.1+ for Laravel 10, PHP 8.2+ for Laravel 11\n";
}
