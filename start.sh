#!/bin/sh

echo "Starting Laravel..."

php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

php artisan storage:link || true

php artisan migrate --force

apache2-foreground