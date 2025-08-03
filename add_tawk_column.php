<?php

// Quick script to add tawk_js column to site_settings table
require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'database' => 'meetmytech',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

try {
    // Check if column exists
    $columns = Capsule::select("SHOW COLUMNS FROM site_settings LIKE 'tawk_js'");
    
    if (empty($columns)) {
        // Add the column
        Capsule::statement("ALTER TABLE site_settings ADD COLUMN tawk_js TEXT NULL AFTER seo_keywords");
        echo "Column 'tawk_js' added successfully to site_settings table.\n";
    } else {
        echo "Column 'tawk_js' already exists in site_settings table.\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
