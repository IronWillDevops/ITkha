#!/bin/bash
# ==========================
# Конфигурация
# ==========================
APP_DIR="/var/www/ITkha"
REPO_URL="https://github.com/IronWillDevops/ITkha.git"
BRANCH="master"
PHP_BIN="php"
COMPOSER_BIN="composer"
WEB_USER="www-data"
WEB_GROUP="www-data"
echo "=== Деплой Laravel проекта ITkha ==="
# ==========================
# 1. Клонирование или обновление
# ==========================
if [ ! -d "$APP_DIR" ]; then
  echo "[INFO] Клонируем репозиторий..."
  git clone -b $BRANCH $REPO_URL $APP_DIR
else
  echo "[INFO] Репозиторий существует, обновляем..."
  cd $APP_DIR || exit
  git reset --hard
  git pull origin $BRANCH
fi
cd $APP_DIR || exit
# ==========================
# 2. Установка PHP-зависимостей
# ==========================
echo "[INFO] Установка PHP-зависимостей..."
$COMPOSER_BIN install --no-interaction --prefer-dist --optimize-autoloader
# ==========================
# 3. Установка JS-зависимостей (если есть)
# ==========================
if [ -f "package.json" ]; then
  echo "[INFO] Установка JS-зависимостей..."
  npm install
  npm run build
fi
# ==========================
# 4. Настройка окружения
# ==========================
if [ ! -f ".env" ]; then
  echo "[INFO] Копируем .env.example..."
  cp .env.example .env
  $PHP_BIN artisan key:generate
fi
# ==========================
# 5. Права доступа
# ==========================
echo "[INFO] Настройка прав на storage и bootstrap/cache..."
sudo chown -R $WEB_USER:$WEB_GROUP storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
# ==========================
# 6. Миграции
# ==========================
echo "[INFO] Запуск миграций..."
$PHP_BIN artisan migrate --force || {
  echo "[ERROR] Ошибка при миграциях. Проверь подключение к базе данных."
  exit 1
}
# ==========================
# 7. Очистка и кэширование
# ==========================
echo "[INFO] Очистка кэша..."
$PHP_BIN artisan config:clear
$PHP_BIN artisan cache:clear
$PHP_BIN artisan route:clear
$PHP_BIN artisan view:clear
echo "[INFO] Кэширование конфигов..."
$PHP_BIN artisan config:cache
$PHP_BIN artisan route:cache
$PHP_BIN artisan view:cache
# ==========================
# 8. Перезапуск PHP-FPM
# ==========================
if systemctl is-active --quiet php8.2-fpm; then  
echo "[INFO] Перезапуск PHP-FPM..."
  sudo systemctl restart php8.2-fpm
elif systemctl is-active --quiet php8.1-fpm; then
  echo "[INFO] Перезапуск PHP-FPM..."
  sudo systemctl restart php8.1-fpm
elif systemctl is-active --quiet php7.4-fpm; then
  echo "[INFO] Перезапуск PHP-FPM..."
  sudo systemctl restart php7.4-fpm
fi
echo "=== Деплой завершен успешно! ==="