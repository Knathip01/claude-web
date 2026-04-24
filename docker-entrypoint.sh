#!/bin/bash
set -e

# No need to copy .env here as it is done in Dockerfile.

# Ensure SQLite database exists
mkdir -p database
touch database/database.sqlite

# Set permissions
chown -R www-data:www-data storage bootstrap/cache database
chmod -R 775 storage bootstrap/cache database

# Run migrations
php artisan migrate --force 2>/dev/null || true

# Cache config for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start Apache
exec apache2-foreground
