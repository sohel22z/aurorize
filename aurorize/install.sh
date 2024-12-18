#!/bin/sh
# php composer.phar install --ignore-platform-reqs
php composer.phar install
# php composer.phar install --optimize-autoloader --no-dev
sudo cp .env.example .env
php artisan migrate --seed
php artisan passport:install
sudo chmod -R 777 storage/
sudo mkdir -p public/upload
sudo chmod -R 777 public/upload