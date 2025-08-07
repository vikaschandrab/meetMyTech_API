@echo off
echo === Laravel Composer Fix ===
cd /d "f:\Laravel\meetMyTech\meetMyTech_API"
echo Current directory: %CD%
echo.

echo Removing old vendor directory...
if exist vendor rmdir /s /q vendor
echo.

echo Removing old composer.lock...
if exist composer.lock del composer.lock
echo.

echo Running composer install...
composer install --no-scripts --ignore-platform-reqs
echo.

echo Testing Laravel...
php artisan --version
echo.

echo === Complete ===
pause
