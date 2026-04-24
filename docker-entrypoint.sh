#!/bin/bash
set -e

# Setup .env if not exists
if [ ! -f .env ]; then
    cp .env.example .env
    php artisan key:generate
fi

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
