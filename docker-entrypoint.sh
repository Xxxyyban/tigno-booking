#!/bin/sh
set -e

# Run Laravel optimizations and migrations
php artisan config:clear
php artisan migrate --force

# Execute the main container command (Apache)
exec "$@"