# Usa la imagen oficial de PHP con extensiones necesarias
FROM php:8.2-fpm

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia el proyecto
WORKDIR /var/www
COPY . .

# Instala dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Genera la APP_KEY y crea el enlace de storage
RUN php artisan config:clear \
    && php artisan key:generate \
    && php artisan storage:link

# Establece permisos si es necesario
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Puerto por defecto de Laravel
EXPOSE 8000

# Comando para iniciar Laravel (puedes usar otro si usas nginx o supervisor)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
