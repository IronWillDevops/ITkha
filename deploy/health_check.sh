#!/bin/bash
# ==========================
# ITkha Health Check Script
# ==========================

APP_DIR="/var/www/ITkha"
WEB_USER="www-data"

# Color definitions
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
BLUE='\033[0;34m'
RESET='\033[0m'

echo -e "${BLUE}=== ITkha Application Health Check ===${RESET}"
echo ""

# ==========================
# Check PHP-FPM
# ==========================
echo -e "${BLUE}[1] PHP-FPM Status:${RESET}"
PHP_VERSION=""
for version in 8.3 8.2 8.1 7.4; do
    if systemctl is-active --quiet php${version}-fpm; then
        PHP_VERSION=$version
        echo -e "   ${GREEN}✓${RESET} PHP-FPM ${version} is running"
        break
    fi
done

if [ -z "$PHP_VERSION" ]; then
    echo -e "   ${RED}✗${RESET} No PHP-FPM service is running"
fi
echo ""

# ==========================
# Check Queue Worker
# ==========================
echo -e "${BLUE}[2] Queue Worker Status:${RESET}"
if systemctl is-active --quiet laravel-queue.service; then
    echo -e "   ${GREEN}✓${RESET} Queue Worker service is running"
    
    # Check if enabled for autostart
    if systemctl is-enabled --quiet laravel-queue.service; then
        echo -e "   ${GREEN}✓${RESET} Queue Worker autostart is enabled"
    else
        echo -e "   ${YELLOW}⚠${RESET} Queue Worker autostart is disabled"
        echo -e "       Run: sudo systemctl enable laravel-queue"
    fi
    
    # Check process
    if ps aux | grep -v grep | grep "queue:work" > /dev/null; then
        QUEUE_PID=$(ps aux | grep -v grep | grep "queue:work" | awk '{print $2}')
        echo -e "   ${GREEN}✓${RESET} Queue Worker process is active (PID: $QUEUE_PID)"
    fi
else
    echo -e "   ${RED}✗${RESET} Queue Worker service is not running"
    echo -e "       Run: sudo systemctl start laravel-queue"
fi
echo ""

# ==========================
# Check CRON for Scheduler
# ==========================
echo -e "${BLUE}[3] Laravel Scheduler (CRON):${RESET}"
if sudo crontab -u $WEB_USER -l 2>/dev/null | grep -q "schedule:run"; then
    echo -e "   ${GREEN}✓${RESET} CRON job for Laravel Scheduler is configured"
    echo -e "   $(sudo crontab -u $WEB_USER -l 2>/dev/null | grep 'schedule:run')"
else
    echo -e "   ${RED}✗${RESET} CRON job for Laravel Scheduler is not configured"
    echo -e "       Run the 2_deploy_post_migrate.sh script to set it up"
fi
echo ""

# ==========================
# Check Database Connection
# ==========================
echo -e "${BLUE}[4] Database Connection:${RESET}"
cd $APP_DIR || exit

if php artisan db:show > /dev/null 2>&1; then
    echo -e "   ${GREEN}✓${RESET} Database connection is working"
    DB_CONNECTION=$(php -r "require 'vendor/autoload.php'; \$env = Dotenv\Dotenv::createImmutable(__DIR__); \$env->load(); echo getenv('DB_CONNECTION');")
    echo -e "   Connection: $DB_CONNECTION"
else
    echo -e "   ${RED}✗${RESET} Database connection failed"
    echo -e "       Check your .env file and database credentials"
fi
echo ""

# ==========================
# Check Storage Permissions
# ==========================
echo -e "${BLUE}[5] Storage Permissions:${RESET}"
STORAGE_WRITABLE=true

for dir in "storage/logs" "storage/framework/cache" "storage/framework/sessions" "storage/framework/views" "bootstrap/cache"; do
    if sudo -u $WEB_USER test -w "$APP_DIR/$dir"; then
        echo -e "   ${GREEN}✓${RESET} $dir is writable"
    else
        echo -e "   ${RED}✗${RESET} $dir is not writable"
        STORAGE_WRITABLE=false
    fi
done

if [ "$STORAGE_WRITABLE" = false ]; then
    echo -e "   ${YELLOW}⚠${RESET} Fix permissions with:"
    echo -e "       sudo chown -R $WEB_USER:$WEB_USER storage bootstrap/cache"
    echo -e "       sudo chmod -R 775 storage bootstrap/cache"
fi
echo ""

# ==========================
# Check Storage Link
# ==========================
echo -e "${BLUE}[6] Storage Symbolic Link:${RESET}"
if [ -L "$APP_DIR/public/storage" ]; then
    TARGET=$(readlink -f "$APP_DIR/public/storage")
    if [ "$TARGET" = "$APP_DIR/storage/app/public" ]; then
        echo -e "   ${GREEN}✓${RESET} Storage link is correctly configured"
    else
        echo -e "   ${YELLOW}⚠${RESET} Storage link exists but points to wrong location"
        echo -e "       Expected: $APP_DIR/storage/app/public"
        echo -e "       Actual: $TARGET"

        echo -e "       Run: php artisan storage:link"
    fi
else
    echo -e "   ${RED}✗${RESET} Storage symbolic link does not exist"
    echo -e "       Run: php artisan storage:link"
fi
echo ""

# ==========================
# Check Queue Status
# ==========================
echo -e "${BLUE}[7] Queue Jobs:${RESET}"
FAILED_JOBS=$(php artisan queue:failed 2>/dev/null | grep -c "| ID")
if [ "$FAILED_JOBS" -eq 0 ]; then
    echo -e "   ${GREEN}✓${RESET} No failed jobs"
else
    echo -e "   ${YELLOW}⚠${RESET} There are $FAILED_JOBS failed jobs"
    echo -e "       View with: php artisan queue:failed"
    echo -e "       Retry all: php artisan queue:retry all"
fi
echo ""

# ==========================
# Check Logs
# ==========================
echo -e "${BLUE}[8] Recent Logs:${RESET}"

# Queue Worker Errors
if [ -f "/var/log/laravel-queue-error.log" ]; then
    ERROR_COUNT=$(wc -l < /var/log/laravel-queue-error.log)
    if [ "$ERROR_COUNT" -gt 0 ]; then
        echo -e "   ${YELLOW}⚠${RESET} Queue Worker has $ERROR_COUNT error log entries"
        echo -e "       View with: sudo tail -n 20 /var/log/laravel-queue-error.log"
    else
        echo -e "   ${GREEN}✓${RESET} No Queue Worker errors"
    fi
fi

# Laravel Application Errors
LARAVEL_LOG="$APP_DIR/storage/logs/laravel.log"
if [ -f "$LARAVEL_LOG" ]; then
    ERROR_COUNT=$(grep -c "ERROR" "$LARAVEL_LOG" 2>/dev/null || echo 0)
    if [ "$ERROR_COUNT" -gt 0 ]; then
        echo -e "   ${YELLOW}⚠${RESET} Application log contains $ERROR_COUNT ERROR entries"
        echo -e "       View with: tail -n 50 $LARAVEL_LOG"
    else
        echo -e "   ${GREEN}✓${RESET} No application errors in current log"
    fi
fi
echo ""

# ==========================
# Check Disk Space
# ==========================
echo -e "${BLUE}[9] Disk Space:${RESET}"
DISK_USAGE=$(df -h $APP_DIR | awk 'NR==2 {print $5}' | sed 's/%//')
if [ "$DISK_USAGE" -lt 80 ]; then
    echo -e "   ${GREEN}✓${RESET} Disk usage: ${DISK_USAGE}%"
else
    echo -e "   ${YELLOW}⚠${RESET} Disk usage is high: ${DISK_USAGE}%"
    echo -e "       Consider cleaning up old files"
fi
echo ""

# ==========================
# Check Environment
# ==========================
echo -e "${BLUE}[10] Environment Configuration:${RESET}"
if [ -f "$APP_DIR/.env" ]; then
    echo -e "   ${GREEN}✓${RESET} .env file exists"
    
    # Check important variables
    APP_KEY=$(grep "^APP_KEY=" "$APP_DIR/.env" | cut -d '=' -f2)
    if [ -n "$APP_KEY" ] && [ "$APP_KEY" != "base64:" ]; then
        echo -e "   ${GREEN}✓${RESET} APP_KEY is set"
    else
        echo -e "   ${RED}✗${RESET} APP_KEY is not properly set"
        echo -e "       Run: php artisan key:generate"
    fi
    
    APP_ENV=$(grep "^APP_ENV=" "$APP_DIR/.env" | cut -d '=' -f2)
    if [ "$APP_ENV" = "production" ]; then
        echo -e "   ${GREEN}✓${RESET} Environment: production"
    else
        echo -e "   ${YELLOW}⚠${RESET} Environment: $APP_ENV (not production)"
    fi
    
    APP_DEBUG=$(grep "^APP_DEBUG=" "$APP_DIR/.env" | cut -d '=' -f2)
    if [ "$APP_DEBUG" = "false" ]; then
        echo -e "   ${GREEN}✓${RESET} Debug mode: disabled"
    else
        echo -e "   ${YELLOW}⚠${RESET} Debug mode: enabled (should be false in production)"
    fi
else
    echo -e "   ${RED}✗${RESET} .env file not found"
fi
echo ""

# ==========================
# Summary
# ==========================
echo -e "${BLUE}=== Summary ===${RESET}"
echo -e ""
echo -e "Useful Commands:"
echo -e "  ${GREEN}•${RESET} Restart Queue Worker: ${YELLOW}sudo systemctl restart laravel-queue${RESET}"
echo -e "  ${GREEN}•${RESET} View Queue Logs: ${YELLOW}sudo tail -f /var/log/laravel-queue.log${RESET}"
echo -e "  ${GREEN}•${RESET} View App Logs: ${YELLOW}tail -f $APP_DIR/storage/logs/laravel.log${RESET}"
echo -e "  ${GREEN}•${RESET} Check Failed Jobs: ${YELLOW}php artisan queue:failed${RESET}"
echo -e "  ${GREEN}•${RESET} Clear All Caches: ${YELLOW}php artisan optimize:clear${RESET}"
echo -e ""