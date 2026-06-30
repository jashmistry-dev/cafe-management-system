#!/bin/sh

php artisan config:clear
php artisan cache:clear

php artisan storage:link || true

php artisan migrate --force

apache2-foreground