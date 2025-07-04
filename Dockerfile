# Usa la imagen oficial de PHP con FPM y extensiones necesarias
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

# Establece el directorio de trabajo
WORKDIR /var/www

# Copia los archivos del proyecto
COPY . .

# Instala dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# ⚠️ Crea el symlink manualmente
RUN php artisan storage:link

# Ajusta permisos
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage \
    && chmod -R 775 /var/www/storage/app/public \
    && chmod -R 775 /var/www/public \
    && chmod -R 775 /var/www/bootstrap/cache

# Copia el script de inicio (aunque no se ejecute por ahora)
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Expone el puerto
EXPOSE 8000

# Usa el servidor embebido de Laravel directamente
CMD php artisan serve --host=0.0.0.0 --port=8000
