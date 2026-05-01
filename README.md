# Capybara CRM

A lightweight, self-hosted CRM built with **PHP 8.1+** and **CodeIgniter 4**, designed for small businesses or personal use.

[![Tests](https://github.com/williamjmorenor/capybara-crm/actions/workflows/tests.yml/badge.svg)](https://github.com/williamjmorenor/capybara-crm/actions/workflows/tests.yml)

## Features

- **Contacts** — Full CRUD, status tracking, activity history
- **Leads** — Pipeline management with source/status filtering, lead-to-contact conversion
- **Opportunities** — Kanban board (New → In Progress → Negotiation → Won / Lost)
- **Activities** — Log calls, emails, meetings, and notes linked to any entity
- **Tags** — Flexible labeling system across all entities
- **Dashboard** — At-a-glance stats: leads by status, active opportunities, recent activities
- **Authentication** — Session-based login/logout with Admin and User roles
- **Security** — CSRF protection, bcrypt password hashing, input validation
- **i18n** — All UI text marked for translation; English and Spanish included

---

## Developer Setup

### System Requirements

| Requirement | Version |
|-------------|---------|
| PHP | 8.1 or higher |
| Composer | 2.x |
| MySQL | 5.7+ / 8.x  *(or MariaDB 10.4+, recommended for production)* |
| SQLite | 3.x *(optional for lightweight local development)* |
| Web server | Apache 2.4+ or Nginx 1.18+ *(or built-in PHP dev server)* |

**Required PHP extensions:**

| Extension | Purpose |
|-----------|---------|
| `dom` | XML/DOM support (required by PHPUnit) |
| `intl` | Locale / language support |
| `mbstring` | Multi-byte string handling |
| `mysqlnd` | MySQL native driver |
| `pdo_sqlite` / `sqlite3` | SQLite driver (optional for local dev) |
| `json` | JSON encode/decode |
| `curl` | HTTP client (optional) |

Check your extensions:

```bash
php -m | grep -E 'dom|intl|mbstring|mysqlnd|sqlite3|pdo_sqlite|json|curl'
```

### Ubuntu / Dev Container Troubleshooting

If you get this error:

```text
php: /lib/x86_64-linux-gnu/libcrypto.so.1.1: version `OPENSSL_1_1_1' not found (required by php)
```

your shell is likely resolving `php` to an older preinstalled binary. Use the system PHP and required extensions:

```bash
sudo apt-get update -y
sudo apt-get install -y php-cli php8.3-xml php8.3-intl php8.3-mbstring php8.3-curl php8.3-sqlite3

# Optional for some Codespaces/dev containers where PATH points to ~/.php/current
ln -sfn /usr /home/codespace/.php/current
```

Then verify:

```bash
php -v
php --ini
php -m | grep -E 'dom|intl|mbstring|curl|sqlite3|pdo_sqlite'
```

### 1. Clone and install Composer dependencies

```bash
git clone https://github.com/williamjmorenor/capybara-crm.git
cd capybara-crm
composer install
```

### 2. Configure the environment

```bash
cp env .env
```

Edit `.env` and choose one database option.

Option A (MySQL / MariaDB):

```ini
CI_ENVIRONMENT = development

app.baseURL = ''

database.default.hostname = localhost
database.default.database = capybara_crm
database.default.username = your_db_user
database.default.password = your_db_password
database.default.DBDriver = MySQLi
database.default.port     = 3306
```

> **Tip:** Create the database first: `CREATE DATABASE capybara_crm CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;`
>
> **Codespaces tip:** Leaving `app.baseURL = ''` avoids hardcoded localhost redirects and uses the current forwarded host.

Option B (SQLite, lightweight local dev):

```ini
CI_ENVIRONMENT = development

app.baseURL = ''

database.default.DBDriver = SQLite3
database.default.database = /absolute/path/to/capybara-crm/writable/database.sqlite
database.default.DBPrefix =
```

If you prefer an explicit value in Codespaces, set:

```ini
app.baseURL = 'https://<your-codespace>-8080.app.github.dev/'
```

Create the SQLite database file before migrations:

```bash
touch writable/database.sqlite
```

If you get Unable to open database file, make sure database.default.database uses an absolute path.

### 3. Run migrations and seed initial data

```bash
php spark migrate
php spark db:seed DatabaseSeeder
```

This creates all 7 tables and inserts a default admin user.

### 4. Start the development server

```bash
php spark serve
```

Open [http://localhost:8080](http://localhost:8080) in your browser.

To bind to a different port or host:

```bash
php spark serve --host 0.0.0.0 --port 9000
```

### Default credentials

| Email | Password | Role |
|-------|----------|------|
| admin@crm.local | Admin1234! | admin |

---

## Running Tests

The test suite uses **PHPUnit 10**. Tests do **not** require a database connection.

```bash
# Run all tests
composer test

# Run with verbose output
./vendor/bin/phpunit --testdox

# Run a specific test file
./vendor/bin/phpunit tests/unit/HealthTest.php
```

Test results and coverage reports are written to `build/logs/`.

### Continuous Integration

GitHub Actions runs the full test suite automatically on every push and pull request across PHP 8.1, 8.2, and 8.3. See [`.github/workflows/tests.yml`](.github/workflows/tests.yml).

---

## Internationalisation (i18n)

All user-facing strings are marked with CodeIgniter's `lang()` helper.

Language files live in `app/Language/{locale}/Crm.php`:

| Locale | File |
|--------|------|
| English | `app/Language/en/Crm.php` |
| Spanish | `app/Language/es/Crm.php` |

### Changing the application language

Edit `app/Config/App.php` and set the default locale:

```php
public string $defaultLocale = 'es';   // 'en' or 'es'
public string $negotiateLocale = false;
```

### Adding a new language

1. Create `app/Language/{locale}/Crm.php`
2. Copy the key list from `app/Language/en/Crm.php`
3. Translate the values

---

## Architecture

```
app/
├── Controllers/        # HTTP layer — AuthController, DashboardController, etc.
├── Models/             # Database layer — ContactModel, LeadModel, etc.
├── Services/           # Business logic — LeadService (conversion), ActivityService
├── Filters/            # Middleware — AuthFilter, AdminFilter
├── Language/
│   ├── en/Crm.php      # English UI strings
│   └── es/Crm.php      # Spanish UI strings
├── Views/
│   ├── layouts/        # Bootstrap 5 responsive layout + auth layout
│   ├── dashboard/
│   ├── contacts/
│   ├── leads/
│   ├── opportunities/  # Kanban board view
│   ├── activities/
│   ├── tags/
│   └── auth/
└── Database/
    ├── Migrations/     # 7 tables: users, contacts, leads, opportunities, activities, tags, taggables
    └── Seeds/          # Default admin user
```

## Web Server Configuration

Point your web server's document root to the **`public/`** directory.

**Apache** — a `.htaccess` file is already included in `public/`.

**Nginx** example:

```nginx
server {
    listen 80;
    server_name crm.local;
    root /var/www/capybara-crm/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.1-fpm.sock;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

## Server Requirements

PHP 8.1+ with extensions: `intl`, `mbstring`, `mysqlnd`, `json`
