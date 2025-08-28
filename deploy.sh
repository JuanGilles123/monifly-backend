#!/bin/bash

# Script de despliegue para MoniFly
echo "🚀 Iniciando despliegue de MoniFly..."

# Copiar .env.example a .env si no existe
if [ ! -f .env ]; then
    echo "📋 Copiando .env.example a .env..."
    cp .env.example .env
fi

# Instalar dependencias de PHP
echo "📦 Instalando dependencias de PHP..."
composer install --optimize-autoloader --no-dev

# Generar clave de aplicación
echo "🔑 Generando clave de aplicación..."
php artisan key:generate --force

# Instalar dependencias de Node.js
echo "📦 Instalando dependencias de Node.js..."
npm ci

# Compilar assets
echo "🏗️ Compilando assets..."
npm run build

# Optimizar Laravel para producción
echo "⚡ Optimizando Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Ejecutar migraciones (solo si la base de datos está configurada)
# php artisan migrate --force

echo "✅ Despliegue completado!"
