#!/bin/bash
set -e

# === VNN Deployment Script ===
# Usage: bash deploy.sh [branch]
# Default branch: main

BRANCH="${1:-main}"
REPO_DIR="/var/www/vnn"

echo "=== Deploying VNN ($BRANCH) ==="
echo "Started: $(date)"

# 1. Pull latest code
echo "--- Pulling $BRANCH ---"
cd "$REPO_DIR"
git fetch origin
git reset --hard "origin/$BRANCH"

# 2. Install PHP dependencies
echo "--- Composer install ---"
composer install --no-dev --optimize-autoloader --no-interaction

# 3. Install & build frontend assets
echo "--- NPM install & build ---"
npm ci --no-audit --no-fund
npm run build

# 4. Environment
echo "--- Environment ---"
if [ ! -f .env ]; then
    cp .env.example .env
    php artisan key:generate --force
fi
php artisan storage:link --force

# 5. Cache
echo "--- Optimizing ---"
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# 6. Migrations
echo "--- Migrating ---"
php artisan migrate --force

# 7. Queues
echo "--- Restarting queue ---"
php artisan queue:restart

# 8. Permissions
echo "--- Permissions ---"
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# 9. Reload PHP-FPM
echo "--- Reloading PHP-FPM ---"
if [ -S /var/run/php/php8.3-fpm.sock ]; then
    php artisan optimize:clear
fi

# 10. Cleanup
echo "--- Cleanup ---"
rm -rf node_modules
php artisan config:clear

echo "=== Deploy complete: $(date) ==="
