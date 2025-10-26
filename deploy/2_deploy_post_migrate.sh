#!/bin/bash
# ==========================
# Configuration
# ==========================
APP_DIR="/var/www/ITkha"
PHP_BIN="php"
WEB_USER="www-data"
WEB_GROUP="www-data"
ADMIN_URL="/admin"
DEFAULT_LOGIN="admin@example.com"
DEFAULT_PASSWORD="password"


# Color definitions
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
RESET='\033[0m'

echo "=== Deploying Laravel project ITkha (post-migrations) ===" 

# ==========================
# 0. Initialize variables
# ==========================
TOTAL_STEPS=9 # Увеличили количество шагов до 9
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


cd $APP_DIR || exit


# ==========================
# 1. Permissions
# ==========================
increment_step "Setting permissions..." 
if sudo chown -R $WEB_USER:$WEB_GROUP storage bootstrap/cache && sudo chmod -R 775 storage bootstrap/cache; then
    success_step "Permissions set successfully." 
else
    error_step "Failed to set permissions." 
    exit 1
fi

# ==========================
# 2. Database migrations + seeding
# ==========================
increment_step "Running migrations and seeding..."
if $PHP_BIN artisan migrate --force > /dev/null 2>&1 && $PHP_BIN artisan db:seed --force > /dev/null 2>&1; then
    success_step "Migrations and seeding completed."
else
    error_step "Migration or seeding failed. Check database connection or seeders."
    exit 1
fi

# ==========================
# 3. Clearing and caching
# ==========================
increment_step "Clearing and caching..."
# Очистка кэшей
$PHP_BIN artisan config:clear > /dev/null 2>&1
$PHP_BIN artisan cache:clear > /dev/null 2>&1
$PHP_BIN artisan route:clear > /dev/null 2>&1
$PHP_BIN artisan view:clear > /dev/null 2>&1

# Кэширование конфигурации, маршрутов и представлений
if $PHP_BIN artisan config:cache && $PHP_BIN artisan route:cache && $PHP_BIN artisan view:cache; then
    success_step "Configuration and routes cached successfully."
else
    error_step "Failed to cache configuration or routes."
    exit 1
fi

# ==========================
# 4. Restart PHP-FPM
# ==========================
increment_step "Restarting PHP-FPM..." 
for version in 8.2 8.1 7.4; do
    if systemctl is-active --quiet php${version}-fpm; then
        sudo systemctl restart php${version}-fpm
        success_step "PHP-FPM ${version} restarted." 
        break
    fi
done

# ==========================
# 5. Setup CRON Job for Laravel Scheduler
# ==========================
increment_step "Setting up Laravel Scheduler CRON job for $WEB_USER..." 

# CRON-задача для запуска планировщика каждую минуту
CRON_JOB="* * * * * cd $APP_DIR && $PHP_BIN artisan schedule:run >> /dev/null 2>&1"

# Проверяем, существует ли CRON-задача для веб-пользователя
if sudo crontab -u $WEB_USER -l 2>/dev/null | grep -Fq "$CRON_JOB"; then
    success_step "CRON job already exists for $WEB_USER."
else
    # Добавляем CRON-задачу
    # Используем `echo -e` и `sudo crontab -u $WEB_USER -` для добавления задачи
    if echo -e "$(sudo crontab -u $WEB_USER -l 2>/dev/null)\n$CRON_JOB" | sudo crontab -u $WEB_USER -; then
        success_step "CRON job added for $WEB_USER. Check crontab -u $WEB_USER -l"
    else
        error_step "Failed to add CRON job for $WEB_USER. Check sudo permissions."
        exit 1
    fi
fi


# ==========================
# 6. Running initial schedule check
# ==========================
increment_step "Running scheduled tasks once for environment check..." 
# Это запускает все задачи, которые должны быть выполнены *сейчас*.
# Для ежедневной синхронизации (03:00) необходим внешний CRON.
if $PHP_BIN artisan schedule:run; then
    success_step "Scheduled tasks ran successfully (initial check). External CRON is now configured."
else
    error_step "Failed to run scheduled tasks."
fi


# ==========================
# 7. Start queue worker (if queues are used)
# ==========================
increment_step "Starting queue worker..." 
# Проверка, работает ли очередь
if ! ps aux | grep -v grep | grep "queue:work" > /dev/null; then
    echo -e "[${YELLOW}INFO${RESET}] Queue worker not running, starting it..." 
    # Запускаем queue:work в фоновом режиме
    nohup $PHP_BIN artisan queue:work --daemon > /dev/null 2>&1 &
    success_step "Queue worker started." 
else
    success_step "Queue worker already running." 
fi

# ==========================
# 8. Show admin access info
# ==========================
increment_step "Showing admin access info..." 

# Try to read APP_URL from .env file
if [ -f ".env" ]; then
    APP_URL=$(grep -E '^APP_URL=' .env | cut -d '=' -f2 | tr -d '"')
else
    APP_URL="http://localhost"
fi

# If APP_URL is empty, use fallback
if [ -z "$APP_URL" ]; then
    APP_URL="http://localhost"
fi
echo ""
echo -e "==========================================="
echo -e "🚀 ${GREEN}Deployment completed successfully!${RESET}"
echo -e "==========================================="
echo -e "Admin panel address:"
echo -e "   ${APP_URL}${ADMIN_URL}"
echo ""
echo -e "Default admin credentials:"
echo -e "   Login:    ${DEFAULT_LOGIN}"
echo -e "   Password: ${DEFAULT_PASSWORD}"
echo ""
echo -e "⚠️  ${RED}For security, please change this password immediately after first login.${RESET}"
echo ""
echo -e "💡 ${YELLOW}Don't forget to save your APP_KEY!${RESET} It is crucial for the proper functioning of your application."
echo -e "==========================================="

# ==========================
# 9. Recommended PHP limits
# ==========================
increment_step "Checking PHP upload limits..."
PHP_VERSION=$(php -r "echo PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION;")
echo ""
echo -e "[${YELLOW}RECOMMENDATION${RESET}] Review PHP upload limits:"
echo ""
echo -e "   Minimum recommended values:"
echo -e "      post_max_size = 100M"
echo -e "      upload_max_filesize = 100M"
echo ""
echo -e "   These parameters should be adjusted in your PHP-FPM configuration file, typically located at:"
echo -e "      /etc/php/$PHP_VERSION/fpm/php.ini"
echo ""
echo -e "   After modification, apply changes with:"
echo -e "      sudo systemctl restart php$PHP_VERSION-fpm"
echo ""
