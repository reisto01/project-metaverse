# Project Metaverse

Laravel marketplace and administration application for metaverse land and properties.

## Requirements

- PHP 8.2+
- Composer 2
- MySQL/PostgreSQL, or SQLite for local development

The UI assets are committed under `public/`; no Node.js build is required.

## Local setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Configure `DB_*`, mail, and application URL values in `.env`. To provision the first administrator, set `ADMIN_EMAIL` and `ADMIN_PASSWORD` before running the seeder. `ADMIN_NAME` and `ADMIN_USERNAME` are optional.

## Tests

```bash
php artisan test
composer audit
```

Tests use an in-memory SQLite database and cover registration roles, login, admin authorization, profile ownership, URL validation, and schema consistency.

## Deployment

The included Docker image installs production Composer dependencies and runs cached configuration, migrations, and idempotent role/admin seeders during startup. Production deployments must use persistent database and storage services; do not use a repository SQLite file for live data.

## Security notes

- Public registration always creates a regular user.
- Administrative routes require authenticated role `1` accounts.
- Passwords use Laravel's adaptive hash. Legacy MD5 values are rehashed after a successful login.
- Uploaded images are type/size validated and stored with generated filenames.
- Marketplace links accept only HTTP/HTTPS URLs.
