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

# Color definitions
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
RESET='\033[0m'

echo "=== Deploying Laravel project ITkha (pre-migrations) ==="

# ==========================
# 0. Initialize variables
# ==========================
TOTAL_STEPS=6
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

# ==========================
# 1. Clone or update repository
# ==========================

increment_step "Cloning or updating the repository..."
if [ ! -d "$APP_DIR" ]; then
  if git clone -b $BRANCH $REPO_URL $APP_DIR > /dev/null 2>&1; then
    success_step "Repository cloned successfully."
  else
    error_step "Failed to clone repository."
    exit 1
  fi
else
  cd $APP_DIR || exit
  git reset --hard > /dev/null 2>&1
  if git pull origin $BRANCH > /dev/null 2>&1; then
    success_step "Repository updated successfully."
  else
    error_step "Failed to update repository."
    exit 1
  fi
fi

cd $APP_DIR || exit

# ==========================
# 2. Install PHP dependencies
# ==========================
increment_step "Installing PHP dependencies with Composer..."
if $COMPOSER_BIN install --no-interaction --prefer-dist --optimize-autoloader > /dev/null 2>&1; then
  success_step "PHP dependencies installed successfully."
else
  error_step "Failed to install PHP dependencies."
  exit 1
fi

# ==========================
# 3. Install JS dependencies (if any)
# ==========================
increment_step "Installing JS dependencies (if any)..."
if [ -f "package.json" ]; then
  if npm install > /dev/null 2>&1 && npm run build > /dev/null 2>&1; then
    success_step "JS dependencies installed and built successfully."
  else
    error_step "Failed to install or build JS dependencies."
    exit 1
  fi
else
  success_step "No JS dependencies found."
fi

# ==========================
# 4. Set up environment file
# ==========================
increment_step "Setting up the environment file..."
if [ ! -f ".env" ]; then
  cp .env.example .env
  if $PHP_BIN artisan key:generate > /dev/null 2>&1; then
    success_step "Environment file set up and key generated."
  else
    error_step "Failed to set up environment file."
    exit 1
  fi
else
  success_step "Environment file already exists."
fi

# ==========================
# 5. Display preparation complete
# ==========================
increment_step "Preparation complete. Configuration is done."

# ==========================
# 6. Instructions for user
# ==========================
increment_step "Instructions for next steps..."
echo -e "${YELLOW}Now edit your .env file with correct database credentials and environment settings.${RESET}"
echo -e "${YELLOW}After that, run: bash 2_deploy_post_migrate.sh${RESET}"
