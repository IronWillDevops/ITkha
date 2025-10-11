#!/bin/bash
# ==========================================
# Laravel project requirements checker
# ==========================================
APP_DIR="/var/www/ITkha"
PHP_BIN="php"
COMPOSER_BIN="composer"
MIN_PHP_VERSION="8.3"
MIN_COMPOSER_VERSION="2.0"
REQUIRED_EXTENSIONS=("bcmath" "calendar" "Core" "ctype" "curl" "date" "dom" "exif" "FFI" "fileinfo" "filter" "ftp" "gd" "gettext" "hash" "iconv" "intl" "json" "libxml" "mbstring" "mysqli" "mysqlnd" "openssl" "pcntl" "pcre" "PDO" "pdo_mysql" "Phar" "posix" "random" "readline" "Reflection" "session" "shmop" "SimpleXML" "sockets" "sodium" "SPL" "standard" "sysvmsg" "sysvsem" "sysvshm" "tokenizer" "xml" "xmlreader" "xmlwriter" "xsl" "Zend OPcache" "zip" "zlib")

# Color definitions
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
RESET='\033[0m'

success_step() {
  echo -e "[${GREEN}SUCCESS${RESET}] $1"
}

error_step() {
  echo -e "[${RED}ERROR${RESET}] $1"
}

check_php_version() {
    # Get the current PHP version
    PHP_VERSION=$($PHP_BIN -r "echo PHP_VERSION;")
    
    # Compare PHP version
    if [[ "$(echo -e "$MIN_PHP_VERSION\n$PHP_VERSION" | sort -V | head -n1)" != "$MIN_PHP_VERSION" ]]; then
        error_step "PHP version is too old. Required: ${MIN_PHP_VERSION}, found: ${PHP_VERSION}."
        exit 1
    else
        success_step "PHP version is sufficient: ${PHP_VERSION}."
    fi
}

check_composer_version() {
    # Get the current Composer version
    COMPOSER_VERSION=$($COMPOSER_BIN --version | awk '{print $3}')
    
    # Compare Composer version
    if [[ "$(echo -e "$MIN_COMPOSER_VERSION\n$COMPOSER_VERSION" | sort -V | head -n1)" != "$MIN_COMPOSER_VERSION" ]]; then
        error_step "Composer version is too old. Required: ${MIN_COMPOSER_VERSION}, found: ${COMPOSER_VERSION}."
        exit 1
    else
        success_step "Composer version is sufficient: ${COMPOSER_VERSION}."
    fi
}

check_required_extensions() {
    echo -e "[${YELLOW}CHECK${RESET}] Checking required PHP extensions..."

    for EXT in "${REQUIRED_EXTENSIONS[@]}"; do
        if ! php -m | grep -q "$EXT"; then
            error_step "Missing required PHP extension: ${EXT}."
            exit 1
        else
            success_step "PHP extension ${EXT} is installed."
        fi
    done
}

check_php_fpm() {
    echo -e "[${YELLOW}CHECK${RESET}] Checking if PHP-FPM is running..."

    if ! systemctl is-active --quiet php8.3-fpm; then
        error_step "PHP-FPM is not running."
        exit 1
    else
        success_step "PHP-FPM is running."
    fi
}

# ==========================================
# Run all checks
# ==========================================
echo "==========================================="
echo "🔧 Checking Laravel project requirements"
echo "==========================================="

check_php_version
check_composer_version
check_required_extensions
check_php_fpm

echo "==========================================="
success_step "All requirements are satisfied."
echo "==========================================="