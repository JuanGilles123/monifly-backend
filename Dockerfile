# Dockerfile para MoniFly Backend
FROM php:8.2-fpm-alpine

# Instalar dependencias del sistema
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    postgresql-dev \
    nodejs \
    npm

# Instalar extensiones PHP
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www

# Copiar composer files
COPY composer.json composer.lock ./

# Instalar dependencias PHP
RUN composer install --no-scripts --no-autoloader --no-dev

# Copiar package files
COPY package.json package-lock.json ./

# Instalar dependencias Node.js
RUN npm ci

# Copiar código fuente
COPY . .

# Copiar .env.example a .env
RUN cp .env.example .env

# Completar instalación de Composer
RUN composer dump-autoload --optimize

# Generar clave de aplicación
RUN php artisan key:generate --force

# Compilar assets
RUN npm run build

# Optimizar para producción
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Cambiar permisos
RUN chown -R www-data:www-data /var/www && \
    chmod -R 755 /var/www/storage

# Exponer puerto
EXPOSE 9000

CMD ["php-fpm"]
