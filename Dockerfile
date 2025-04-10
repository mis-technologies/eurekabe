FROM php:8.3-cli

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    zip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libicu-dev \
    libzip-dev \
    libonig-dev \
    cron \
    supervisor \
    nginx \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql intl zip opcache

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents
COPY . .

# Ensure necessary directories exist and set permissions
RUN mkdir -p storage/framework/views storage/framework/sessions storage/framework/cache bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Create the storage symlink
RUN php artisan storage:link

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader --no-progress --no-interaction

# Copy custom Nginx config
COPY nginx.conf /etc/nginx/nginx.conf

# Expose port 80 for Nginx
EXPOSE 80

# Start supervisor (which manages Nginx and PHP-FPM)
CMD ["supervisord", "-c", "/etc/supervisor/supervisord.conf"]
