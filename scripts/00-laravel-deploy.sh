#!/usr/bin/env bash
set -e

echo "Running Laravel deploy hook..."

cd /var/www/html

# Ensure the sqlite file exists even if the container filesystem was reset
mkdir -p database
touch database/database.sqlite
chmod 775 database/database.sqlite

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

echo "Laravel deploy hook complete."
