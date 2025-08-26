#!/bin/bash

# -------------------------------
# Laravel Deployment Script
# -------------------------------

# Variables
PROJECT_DIR="/var/www/laravel"
LOG_FILE="$PROJECT_DIR/deploy.log"
DATE=$(date '+%Y-%m-%d %H:%M:%S')

echo "=== Deployment started at $DATE ===" >> $LOG_FILE

# Navigate to project
cd $PROJECT_DIR || { echo "Directory not found" >> $LOG_FILE; exit 1; }

# Pull latest changes
echo "Pulling latest changes..." >> $LOG_FILE
git fetch origin main
git reset --hard origin/main

# Install/update composer dependencies
echo "Installing composer dependencies..." >> $LOG_FILE
composer install --no-dev --optimize-autoloader >> $LOG_FILE 2>&1

# Run database migrations safely
echo "Running migrations..." >> $LOG_FILE
php artisan migrate --force >> $LOG_FILE 2>&1

# Clear and cache configs, routes, views
echo "Caching configs, routes, views..." >> $LOG_FILE
php artisan config:cache >> $LOG_FILE 2>&1
php artisan route:cache >> $LOG_FILE 2>&1
php artisan view:cache >> $LOG_FILE 2>&1

# Set proper permissions
echo "Setting permissions..." >> $LOG_FILE
chown -R www-data:www-data $PROJECT_DIR/storage $PROJECT_DIR/bootstrap/cache
chmod -R 775 $PROJECT_DIR/storage $PROJECT_DIR/bootstrap/cache

# Restart web server
echo "Restarting Apache..." >> $LOG_FILE
sudo systemctl restart apache2 >> $LOG_FILE 2>&1

echo "=== Deployment finished at $(date '+%Y-%m-%d %H:%M:%S') ===" >> $LOG_FILE
