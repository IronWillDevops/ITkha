#!/bin/bash
# ==========================================
# Laravel project update script (improved)
# ==========================================
APP_DIR="/var/www/ITkha"
BRANCH="master"
PHP_BIN="php"
COMPOSER_BIN="composer"
WEB_USER="www-data"
WEB_GROUP="www-data"
DEPLOY_USER="deploy"

# Color definitions
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
RESET='\033[0m'

cd $APP_DIR || exit

# ==========================================
# 0. Initialize variables
# ==========================================
TOTAL_STEPS=13
CURRENT_STEP=0

increment_step() {
  CURRENT_STEP=$((CURRENT_STEP + 1))
  echo -e "[${YELLOW}STEP $CURRENT_STEP/$TOTAL_STEPS${RESET}] $1"
}

success_step() {
  echo -e "[${GREEN}SUCCESS${RESET}] $1"
}

error_step() {
  echo -e "[${RED}ERROR${RESET}] $1"
}

# ==========================================
# Generate random key for maintenance mode
# ==========================================
RANDOM_KEY=$(openssl rand -base64 32)

# ==========================================
# Enable maintenance mode
# ==========================================
increment_step "Putting the site into maintenance mode..."
$PHP_BIN artisan down --secret="$RANDOM_KEY"

echo -e "[${YELLOW}INFO${RESET}] The site is in maintenance mode."
echo -e "[${GREEN}ACCESS KEY${RESET}]: $RANDOM_KEY"

# ==========================================
# STEP 1. Stop queue worker service (if exists)
# ==========================================
increment_step "Stopping queue worker service..."
if systemctl is-active --quiet laravel-queue.service; then
    sudo systemctl stop laravel-queue.service
    success_step "Queue worker service stopped."
else
    echo -e "[${YELLOW}INFO${RESET}] Queue worker service not running."
fi

# ==========================================
# STEP 2. Update source code from Git
# ==========================================
increment_step "Updating repository..."
cd $APP_DIR || { error_step "Application directory not found."; exit 1; }

git fetch origin $BRANCH > /dev/null 2>&1 && \
 git reset --hard origin/$BRANCH > /dev/null 2>&1

if [ $? -eq 0 ]; then
  success_step "Repository updated."
else
  error_step "Git update failed."
  exit 1
fi

# ==========================================
# STEP 3. Fix permissions BEFORE build
# ==========================================
increment_step "Fixing permissions for public directory..."
if sudo chown -R $WEB_USER:$WEB_GROUP public && \
   sudo chmod -R 775 public; then
    success_step "Public directory permissions fixed."
else
    error_step "Failed to set public directory permissions."
    exit 1
fi

# ==========================================
# STEP 4. Update PHP dependencies
# ==========================================
increment_step "Updating Composer dependencies..."
$COMPOSER_BIN install --no-interaction --prefer-dist --optimize-autoloader > /dev/null 2>&1
if [ $? -eq 0 ]; then
  success_step "Composer dependencies updated."
else
  error_step "Composer install failed."
  exit 1
fi

# ==========================================
# STEP 5. Create storage symbolic link
# ==========================================
increment_step "Creating storage symbolic link..."

STORAGE_LINK="$APP_DIR/public/storage"
TARGET="$APP_DIR/storage/app/public"

if [ -L "$STORAGE_LINK" ]; then
    sudo rm "$STORAGE_LINK"
    echo -e "[${YELLOW}INFO${RESET}] Old storage link removed."
fi

$PHP_BIN artisan storage:link

if [ -L "$STORAGE_LINK" ] && [ "$(readlink -f $STORAGE_LINK)" = "$TARGET" ]; then
    success_step "Storage symbolic link created correctly."
else
    error_step "Failed to create correct storage link."
fi

# ==========================================
# STEP 6. Update NPM dependencies (if exists)
# ==========================================
if [ -f "package.json" ]; then
  increment_step "Updating NPM dependencies..."
  npm install --silent > /dev/null 2>&1 && npm run build > /dev/null 2>&1
  if [ $? -eq 0 ]; then
    success_step "NPM dependencies updated."
  else
    error_step "NPM build failed."
  fi
fi

# ==========================================
# STEP 7. Run migrations
# ==========================================
increment_step "Running database migrations..."
$PHP_BIN artisan migrate --force --seed > /dev/null 2>&1
if [ $? -eq 0 ]; then
  success_step "Database migrations completed."
else
  error_step "Migration failed."
  exit 1
fi

# ==========================================
# STEP 8. Clear and rebuild caches
# ==========================================
increment_step "Clearing and rebuilding caches..."
$PHP_BIN artisan optimize:clear > /dev/null 2>&1
$PHP_BIN artisan optimize > /dev/null 2>&1

if [ $? -eq 0 ]; then
  success_step "Caches cleared and rebuilt."
else
  error_step "Cache clear/rebuild failed."
  exit 1
fi

# ==========================================
# STEP 9. Set correct storage permissions
# ==========================================
increment_step "Setting storage/bootstrap permissions..."
if sudo chown -R $WEB_USER:$WEB_GROUP storage bootstrap/cache && \
   sudo chmod -R 775 storage bootstrap/cache; then
  success_step "Permissions set successfully."
else
  error_step "Failed to set permissions."
  exit 1
fi

# ==========================================
# STEP 10. Restart PHP-FPM
# ==========================================
increment_step "Restarting PHP-FPM..."
for version in 8.3 8.2 8.1 7.4; do
  if systemctl is-active --quiet php${version}-fpm; then
    sudo systemctl restart php${version}-fpm > /dev/null 2>&1
    ACTIVE_VERSION=$version
    success_step "PHP-FPM (version ${ACTIVE_VERSION}) restarted."
    break
  fi
done

# ==========================================
# STEP 11. Restart queue worker service
# ==========================================
increment_step "Restarting queue worker service..."
if systemctl list-unit-files | grep -q "laravel-queue.service"; then
    sudo systemctl daemon-reload
    sudo systemctl restart laravel-queue.service
    
    if systemctl is-active --quiet laravel-queue.service; then
        success_step "Queue worker service restarted successfully."
    else
        error_step "Queue worker service failed to start. Check: sudo systemctl status laravel-queue"
    fi
else
    error_step "Queue worker service not found. Run 2_deploy_post_migrate.sh to set it up."
fi

# ==========================================
# STEP 12. Restart queued jobs
# ==========================================
increment_step "Restarting queued jobs..."
$PHP_BIN artisan queue:restart > /dev/null 2>&1
success_step "Queue jobs restarted."

# ==========================================
# STEP 13. Bring site up
# ==========================================
increment_step "Finishing..."
$PHP_BIN artisan up

echo ""
echo -e "==========================================="
echo -e "🚀 ${GREEN}Update completed successfully!${RESET}"
echo -e "==========================================="
if [ -n "$ACTIVE_VERSION" ]; then
  echo -e "✓ PHP-FPM restarted (version ${ACTIVE_VERSION})"
fi
echo -e "✓ Code updated from branch: $BRANCH"
echo -e "✓ Path: $APP_DIR"
echo ""
echo -e "📊 Service Status:"
echo -e "   Queue Worker: $(systemctl is-active laravel-queue.service 2>/dev/null || echo 'not configured')"
echo -e "   Check logs: sudo tail -f /var/log/laravel-queue.log"
echo ""
echo -e "==========================================="