#!/bin/sh
set -e

cd /var/www/html

# Ensure .env exists
if [ ! -f /var/www/html/.env ]; then
  if [ -f /var/www/html/.env.example ]; then
    cp /var/www/html/.env.example /var/www/html/.env
  else
    touch /var/www/html/.env
  fi
fi

# Create SQLite database if needed
if [ "$DB_CONNECTION" = "sqlite" ]; then
  if [ -z "$DB_DATABASE" ]; then
    export DB_DATABASE=/var/www/html/database/database.sqlite
  fi
  mkdir -p "$(dirname "$DB_DATABASE")"
  if [ ! -f "$DB_DATABASE" ]; then
    touch "$DB_DATABASE"
  fi
fi

# Ensure APP_KEY exists
if [ -z "$APP_KEY" ]; then
  php artisan key:generate --force
fi

# Run migrations
php artisan migrate --force

# Optional seeding
if [ "$RUN_SEED" = "true" ]; then
  php artisan db:seed --force
fi

exec "$@"
