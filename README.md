# Capybara CRM

A lightweight, self-hosted CRM built with **PHP 8.1+** and **CodeIgniter 4**, designed for small businesses or personal use.

## Features

- **Contacts** — Full CRUD, status tracking, activity history
- **Leads** — Pipeline management with source/status filtering, lead-to-contact conversion
- **Opportunities** — Kanban board (New → In Progress → Negotiation → Won / Lost)
- **Activities** — Log calls, emails, meetings, and notes linked to any entity
- **Tags** — Flexible labeling system across all entities
- **Dashboard** — At-a-glance stats: leads by status, active opportunities, recent activities
- **Authentication** — Session-based login/logout with Admin and User roles
- **Security** — CSRF protection, bcrypt password hashing, input validation

## Quick Start

### 1. Install dependencies

```bash
composer install
```

### 2. Configure environment

```bash
cp env .env
```

Edit `.env` and set your database credentials:

```ini
CI_ENVIRONMENT = development

database.default.hostname = localhost
database.default.database = capybara_crm
database.default.username = your_user
database.default.password = your_password
database.default.DBDriver = MySQLi
```

Also set a base URL if needed:

```ini
app.baseURL = 'http://localhost:8080/'
```

### 3. Run migrations and seed the database

```bash
php spark migrate
php spark db:seed DatabaseSeeder
```

### 4. Start the development server

```bash
php spark serve
```

Open [http://localhost:8080](http://localhost:8080) in your browser.

### Default credentials

| Email | Password | Role |
|-------|----------|------|
| admin@crm.local | Admin1234! | admin |

---

## Architecture

```
app/
├── Controllers/        # HTTP layer — AuthController, DashboardController, etc.
├── Models/             # Database layer — ContactModel, LeadModel, etc.
├── Services/           # Business logic — LeadService (conversion), ActivityService
├── Filters/            # Middleware — AuthFilter, AdminFilter
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

## Server Requirements

PHP 8.1+ with extensions: `intl`, `mbstring`, `mysqlnd`, `json`

> Configure your web server to point to the `public/` directory of this project.
