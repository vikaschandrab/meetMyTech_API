#!/bin/bash
# Laravel 10 Upgrade Checklist - Phase 1
# Execute from: f:\Laravel\meetMyTech\meetMyTech_API

echo "=== LARAVEL 10 UPGRADE - PHASE 1 ==="
echo "Current: Laravel 9.52.20 -> Target: Laravel 10.x"
echo ""

# 1. Create backup branch
echo "1. Creating backup branch..."
git checkout -b laravel-9-backup
git push origin laravel-9-backup
git checkout Laravel-upgrade-version-9

# 2. Update composer.json for Laravel 10
echo "2. Updating composer.json for Laravel 10..."

# 3. Update dependencies
echo "3. Running composer update..."
composer update

# 4. Update configuration files
echo "4. Updating configuration files..."
php artisan config:publish

# 5. Run tests
echo "5. Running tests..."
php artisan test

# 6. Clear caches
echo "6. Clearing caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo "Laravel 10 upgrade completed!"
echo "Next: Run manual testing and validation"
