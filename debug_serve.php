<?php
echo "=== Laravel Serve Troubleshooting ===\n";

// Check if autoload exists
if (file_exists('vendor/autoload.php')) {
    echo "✅ Composer autoload found\n";
} else {
    echo "❌ Composer autoload missing - run 'composer install'\n";
    exit;
}

// Check if APP_KEY is set
$envContent = file_get_contents('.env');
if (strpos($envContent, 'APP_KEY=base64:') !== false) {
    echo "✅ APP_KEY is set\n";
} else {
    echo "❌ APP_KEY missing - run 'php artisan key:generate'\n";
}

// Check PHP version
echo "PHP Version: " . phpversion() . "\n";

// Check if Laravel is loadable
try {
    require_once 'vendor/autoload.php';
    echo "✅ Laravel autoload successful\n";
} catch (Exception $e) {
    echo "❌ Laravel autoload failed: " . $e->getMessage() . "\n";
}

// Check if port 8000 is available
$connection = @fsockopen('127.0.0.1', 8000, $errno, $errstr, 5);
if ($connection) {
    echo "❌ Port 8000 is already in use\n";
    fclose($connection);
} else {
    echo "✅ Port 8000 is available\n";
}

echo "\n=== Suggested Solutions ===\n";
echo "1. Try: php artisan serve --port=8001\n";
echo "2. Try: php artisan serve --host=127.0.0.1\n";
echo "3. Check if any antivirus is blocking PHP\n";
echo "4. Run as administrator if needed\n";
