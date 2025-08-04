# Laravel Website with Admin Panel

A Laravel-based website featuring an admin panel, queue processing, and CAPTCHA support via `php-gd`.

## ⚙️ Requirements

- PHP >= 8.1
- Composer
- MySQL
- Redis (optional, for queue)
- PHP extension: `php-gd`
- Web server (e.g., Nginx or Apache)
- Supervisor or process manager (for queue workers)

## 🚀 Installation

1. Clone the repository:

```bash
git clone https://github.com/your-username/your-repo.git
cd your-repo
```

2. Install PHP dependencies:

```bash
composer install
```

3. Copy the .env.example file to .env and fill in the required configuration:

```bash
cp .env.example .env
```

4. Generate the application key:

```bash
php artisan key:generate
```

5. Run database migrations and seeders:

```bash
php artisan migrate --seed
```

6. Build frontend assets:

```bash
npm install
npm run build
```

7. Start the queue worker:

```bash
php artisan queue:work
```

> In production, use Supervisor or a process manager to keep the queue worker running.

## 📄 Required .env Configuration

```env
APP_URL=http://example.test
APP_BASE_DOMAIN=example.test
SESSION_DOMAIN=.example.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dbname
DB_USERNAME=root
DB_PASSWORD=password

MAIL_MAILER=smtp
MAIL_HOST=ip-address
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=from@example.com
MAIL_FROM_NAME="${APP_NAME}"
```

>⚠️ Make sure the php-gd extension is installed and enabled for CAPTCHA functionality.

## 🌐 Local Domain Configuration
Update your system’s hosts file:

```hosts
127.0.0.1 example.test
127.0.0.1 admin.example.test
```

## 🔐 Admin Panel
URL: http://admin.example.test

Default credentials:
 - Email: `admin@example.test`
 - Password: `password`

## 📌 Features
Admin panel for managing the application
Email sending configured via SMTP
CAPTCHA support using `php-gd`
Task queue using Laravel’s queue system

## 📄 License
This project is open-source and available under the [[MIT license |https://opensource.org/license/MIT]].