<?php
echo "=== Laravel Bootstrap Test ===\n";

// Test 1: Check if vendor autoload exists
if (file_exists('vendor/autoload.php')) {
    echo "✅ vendor/autoload.php exists\n";

    // Test 2: Try to include autoload
    try {
        require_once 'vendor/autoload.php';
        echo "✅ Autoload included successfully\n";

        // Test 3: Check if Laravel classes exist
        if (class_exists('Illuminate\Foundation\Application')) {
            echo "✅ Laravel Application class found\n";
        } else {
            echo "❌ Laravel Application class NOT found\n";
        }

        // Test 4: Try to instantiate Laravel app
        try {
            $app = new Illuminate\Foundation\Application(
                dirname(__DIR__)
            );
            echo "✅ Laravel Application instantiated\n";
        } catch (Exception $e) {
            echo "❌ Laravel Application instantiation failed: " . $e->getMessage() . "\n";
        }

    } catch (Exception $e) {
        echo "❌ Autoload failed: " . $e->getMessage() . "\n";
    }

} else {
    echo "❌ vendor/autoload.php does not exist\n";
}

echo "\n=== End Test ===\n";
