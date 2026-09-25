#!/usr/bin/env bash
set -e

cd /var/www/html

php artisan db:seed --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Lolita startup hook complete."
