#!/bin/bash
php artisan route:clear
php artisan route:cache
php artisan cache:clear
php artisan serve