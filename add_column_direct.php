<?php

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=meetmytech', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if column exists
    $stmt = $pdo->query("SHOW COLUMNS FROM site_settings LIKE 'tawk_js'");
    $columnExists = $stmt->rowCount() > 0;
    
    if (!$columnExists) {
        // Add the column
        $pdo->exec("ALTER TABLE site_settings ADD COLUMN tawk_js TEXT NULL AFTER seo_keywords");
        echo "SUCCESS: Column 'tawk_js' added to site_settings table.\n";
    } else {
        echo "INFO: Column 'tawk_js' already exists in site_settings table.\n";
    }
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
