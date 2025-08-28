# DigitalOcean App Platform Deployment Configuration

## Buildpacks Configuration:
1. PHP (heroku-php) - Primary buildpack
2. Node.js - Secondary buildpack for asset compilation

## Build Command:
```bash
composer install --no-dev --prefer-dist --optimize-autoloader && php artisan optimize:clear && (npm ci --no-audit --no-fund || npm install --no-audit --no-fund) && npm run build
```

## Run Command:
```bash
heroku-php-apache2 public/
```

## Required Environment Variables:
- APP_NAME=MoniFly
- APP_ENV=production
- APP_DEBUG=false
- APP_URL=https://monifly.app
- APP_KEY=(generated automatically)
- DB_CONNECTION=pgsql
- DB_HOST=(from managed database)
- DB_PORT=25060
- DB_DATABASE=(from managed database)
- DB_USERNAME=(from managed database)
- DB_PASSWORD=(from managed database)
- SESSION_DRIVER=cookie
- CACHE_DRIVER=file
- QUEUE_CONNECTION=database

## Post-deployment verification:
Check these URLs load successfully with 200 OK:
- https://monifly.app/
- https://monifly.app/health
- https://monifly.app/build/assets/app-*.css
- https://monifly.app/build/assets/app-*.js
