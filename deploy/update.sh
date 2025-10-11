#!/bin/bash
# ==========================================
# Laravel project update script
# ==========================================
APP_DIR="/var/www/ITkha"
BRANCH="master"
PHP_BIN="php"
COMPOSER_BIN="composer"
WEB_USER="www-data"
WEB_GROUP="www-data"

# Color definitions
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
RESET='\033[0m'

cd $APP_DIR || exit

# ==========================================
# 0. Initialize variables
# ==========================================
TOTAL_STEPS=10
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

# Show the info for the user
echo -e "[${YELLOW}INFO${RESET}] The site is in maintenance mode. You can access it using the following key:"
echo -e "[${GREEN}ACCESS KEY${RESET}]: $RANDOM_KEY"
echo -e "[${YELLOW}INFO${RESET}] Share this key with authorized users to access the site during the update process."


# ==========================================
# STEP 1. Update source code from Git
# ==========================================
increment_step "Updating repository..."
cd $APP_DIR || { error_step "Application directory not found."; exit 1; }

if git fetch origin $BRANCH> /dev/null 2>&1  && git reset --hard origin/$BRANCH > /dev/null 2>&1;  then
  success_step "Repository updated."
else
  error_step "Git update failed."
  exit 1
fi

# ==========================================
# STEP 2. Update PHP dependencies
# ==========================================
increment_step "Updating Composer dependencies..."
if $COMPOSER_BIN install --no-interaction --prefer-dist --optimize-autoloader > /dev/null 2>&1; then
  success_step "Composer dependencies updated."
else
  error_step "Composer install failed."
  exit 1
fi

# ==========================================
# STEP 3. Update JS dependencies (if package.json exists)
# ==========================================
if [ -f "package.json" ]; then
  increment_step "Updating NPM dependencies..."
  if npm install --silent > /dev/null 2>&1 && npm run build > /dev/null 2>&1; then
    success_step "NPM dependencies updated."
  else
    error_step "NPM build failed."
  fi
fi

# ==========================================
# STEP 4. Run migrations (safe mode)
# ==========================================
increment_step "Running database migrations..."
if $PHP_BIN artisan migrate --force > /dev/null 2>&1; then
  success_step "Database migrations completed."
else
  error_step "Migration failed."
  exit 1
fi

# ==========================================
# STEP 5. Clear and rebuild caches
# ==========================================
increment_step "Clearing and rebuilding caches..."
if $PHP_BIN artisan config:clear > /dev/null 2>&1 && $PHP_BIN artisan cache:clear > /dev/null 2>&1 && $PHP_BIN artisan route:clear > /dev/null 2>&1 && $PHP_BIN artisan view:clear > /dev/null 2>&1 && $PHP_BIN artisan config:cache > /dev/null 2>&1 && $PHP_BIN artisan route:cache > /dev/null 2>&1 && $PHP_BIN artisan view:cache > /dev/null 2>&1; then
  success_step "Caches cleared and rebuilt."
else
  error_step "Cache clear/rebuild failed."
  exit 1
fi

# ==========================================
# STEP 6. Set correct permissions
# ==========================================
increment_step "Setting permissions..."
if sudo chown -R $WEB_USER:$WEB_GROUP storage bootstrap/cache && sudo chmod -R 775 storage bootstrap/cache; then
  success_step "Permissions set successfully."
else
  error_step "Failed to set permissions."
  exit 1
fi

# ==========================================
# STEP 7. Restart PHP-FPM
# ==========================================
increment_step "Restarting PHP-FPM..."
for version in 8.3; do
  if systemctl is-active --quiet php${version}-fpm; then
    sudo systemctl restart php${version}-fpm > /dev/null 2>&1
    ACTIVE_VERSION=$version
    success_step "PHP-FPM (version ${ACTIVE_VERSION}) restarted."
    break
  fi
done

# ==========================================
# STEP 8. Check queue worker status (optional)
# ==========================================
increment_step "Checking queue worker status..."
if ! ps aux | grep -v grep | grep "queue:work" > /dev/null; then
  nohup $PHP_BIN artisan queue:work --daemon > /dev/null 2>&1 &
  success_step "Queue worker started."
else
  success_step "Queue worker is already running."
fi

# ==========================================
# STEP 9. Done
# ==========================================
increment_step "Update completed successfully."
$PHP_BIN artisan up
if [ -n "$ACTIVE_VERSION" ]; then
  success_step "PHP-FPM restarted (version ${ACTIVE_VERSION})."
fi
success_step "Code updated from branch: $BRANCH."
success_step "Path: $APP_DIR."
