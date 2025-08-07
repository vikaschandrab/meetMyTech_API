# Laravel 10 Upgrade Execution Script
# Date: August 7, 2025
# Project: MeetMyTech API

Write-Host "=== LARAVEL 10 UPGRADE PROCESS ===" -ForegroundColor Yellow
Write-Host "Current: Laravel 9.52.20 -> Target: Laravel 10.x" -ForegroundColor Cyan
Write-Host ""

# Step 1: Create backup and new branch
Write-Host "1. Creating backup branch and Laravel 10 upgrade branch..." -ForegroundColor Green
git checkout -b laravel-9-final-backup
git push origin laravel-9-final-backup
git checkout -b laravel-10-upgrade

# Step 2: Backup current composer.json
Write-Host "2. Backing up current composer.json..." -ForegroundColor Green
Copy-Item composer.json composer_laravel9_backup.json

# Step 3: Update composer.json for Laravel 10
Write-Host "3. Updating composer.json for Laravel 10..." -ForegroundColor Green
Copy-Item composer_laravel10.json composer.json

# Step 4: Clear all caches before update
Write-Host "4. Clearing all caches..." -ForegroundColor Green
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Step 5: Update dependencies
Write-Host "5. Updating Composer dependencies (this may take several minutes)..." -ForegroundColor Green
composer update --no-dev --optimize-autoloader

# Step 6: Check for Laravel 10 compatibility
Write-Host "6. Checking Laravel version..." -ForegroundColor Green
php artisan --version

# Step 7: Publish any new configuration files
Write-Host "7. Publishing Laravel 10 configuration files..." -ForegroundColor Green
php artisan config:publish --all

# Step 8: Update database if needed
Write-Host "8. Running database migrations..." -ForegroundColor Green
php artisan migrate --force

# Step 9: Clear and rebuild caches
Write-Host "9. Rebuilding application caches..." -ForegroundColor Green
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Step 10: Run tests to verify upgrade
Write-Host "10. Running application tests..." -ForegroundColor Green
php artisan test --testsuite=Feature

# Step 11: Verify key services
Write-Host "11. Verifying key services..." -ForegroundColor Green
php artisan route:list --name=login
php artisan route:list --name=site

# Step 12: Test file syntax
Write-Host "12. Testing PHP syntax of key files..." -ForegroundColor Green
php -l app/Services/SiteSettingsService.php
php -l app/Services/LoggingService.php
php -l app/Http/Controllers/SiteSettingsController.php

Write-Host ""
Write-Host "=== LARAVEL 10 UPGRADE COMPLETED ===" -ForegroundColor Green
Write-Host ""
Write-Host "Next Steps:" -ForegroundColor Yellow
Write-Host "1. Run manual testing on key features" -ForegroundColor White
Write-Host "2. Test file uploads and image processing" -ForegroundColor White
Write-Host "3. Verify logging system functionality" -ForegroundColor White
Write-Host "4. Check all authentication flows" -ForegroundColor White
Write-Host "5. Deploy to staging environment" -ForegroundColor White
Write-Host ""
Write-Host "If issues occur, run: git checkout Laravel-upgrade-version-9" -ForegroundColor Red
