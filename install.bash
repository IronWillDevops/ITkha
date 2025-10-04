#!/bin/bash
# ==========================
# Configuration
# ==========================
APP_DIR="/var/www/ITkha"
REPO_URL="https://github.com/IronWillDevops/ITkha.git"
BRANCH="master"
PHP_BIN="php"
COMPOSER_BIN="composer"
WEB_USER="www-data"
WEB_GROUP="www-data"

echo "=== Deploying Laravel project ITkha ==="

# ==========================
# 1. Clone or update
# ==========================
if [ ! -d "$APP_DIR" ]; then
  echo "[INFO] Cloning repository..."
  git clone -b $BRANCH $REPO_URL $APP_DIR
else
  echo "[INFO] Repository exists, updating..."
  cd $APP_DIR || exit
  git reset --hard
  git pull origin $BRANCH
fi

cd $APP_DIR || exit
# ==========================
# 2. Install PHP dependencies
# ==========================
echo "[INFO] Installing PHP dependencies..."
$COMPOSER_BIN install --no-interaction --prefer-dist --optimize-autoloader

# ==========================
# 3. Install JS dependencies (if any)
# ==========================
if [ -f "package.json" ]; then
  echo "[INFO] Installing JS dependencies..."
  npm install
  npm run build
fi

# ==========================
# 4. Environment setup
# ==========================
if [ ! -f ".env" ]; then
  echo "[INFO] Copying .env.example..."
  cp .env.example .env
  $PHP_BIN artisan key:generate
fi

# ==========================
# 5. Permissions
# ==========================
echo "[INFO] Setting permissions for storage and bootstrap/cache..."
sudo chown -R $WEB_USER:$WEB_GROUP storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

# ==========================
# 6. Database migrations
# ==========================
echo "[INFO] Running migrations..."
$PHP_BIN artisan migrate --force || {
  echo "[ERROR] Migration failed. Check database connection."
  exit 1
}

# ==========================
# 7. Clearing and caching
# ==========================
echo "[INFO] Clearing cache..."
$PHP_BIN artisan config:clear
$PHP_BIN artisan cache:clear
$PHP_BIN artisan route:clear
$PHP_BIN artisan view:clear

echo "[INFO] Caching configuration..."
$PHP_BIN artisan config:cache
$PHP_BIN artisan route:cache
$PHP_BIN artisan view:cache

# ==========================
# 8. Restart PHP-FPM
# ==========================
if systemctl is-active --quiet php8.2-fpm; then  
  echo "[INFO] Restarting PHP-FPM..."
  sudo systemctl restart php8.2-fpm
elif systemctl is-active --quiet php8.1-fpm; then
  echo "[INFO] Restarting PHP-FPM..."
  sudo systemctl restart php8.1-fpm
elif systemctl is-active --quiet php7.4-fpm; then
  echo "[INFO] Restarting PHP-FPM..."
  sudo systemctl restart php7.4-fpm
fi

echo "=== Deployment completed successfully! ==="
