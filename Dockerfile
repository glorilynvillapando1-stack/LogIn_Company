# Dockerfile
FROM php:8.3-cli

# Install system deps needed for composer, sqlite, zip, etc.
RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

# Install composer (copy from official composer image)
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy only composer files first for faster rebuilds
COPY composer.json composer.lock* /var/www/html/

# Install PHP dependencies
RUN composer install --no-dev --no-interaction --prefer-dist || true

# Copy rest of the app
COPY . /var/www/html

# Ensure storage and bootstrap/cache writable
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true
RUN chmod -R 0777 /var/www/html/storage /var/www/html/bootstrap/cache || true

# Run Laravel's built-in PHP server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
