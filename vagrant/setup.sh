#!/bin/bash

# Clean up repository dependencies
rm -rf composer.lock
rm -rf node_modules
rm -rf vendor

# Setup repository dependencies
composer install
npm install
bower install

# Migrations
php artisan migrate