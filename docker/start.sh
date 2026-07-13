#!/bin/sh
set -e

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link --force

# Run database migrations
php artisan migrate --force
php artisan db:seed --force

# Start PHP-FPM in background
php-fpm -D

# Start Nginx in foreground
nginx -g "daemon off;"
