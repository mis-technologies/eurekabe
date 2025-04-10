FROM php:8.3-fpm

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



# Override PHP settings for larger file uploads
RUN echo "upload_max_filesize = 100M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "memory_limit = 256M" >> /usr/local/etc/php/conf.d/uploads.ini

# Copy existing application directory contents
COPY . .

# Set permissions
# RUN chmod -R 775 storage bootstrap/cache


# Make sure storage dirs exist and are writable
RUN mkdir -p storage/framework/views storage/framework/sessions storage/framework/cache bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache



# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-progress --no-interaction

# Install Node.js & build assets
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && npm install && npm run build

# Nginx configuration
COPY nginx/default.conf /etc/nginx/sites-available/default

# Supervisord configuration to manage nginx and php-fpm
COPY supervisor/supervisord.conf /etc/supervisor/supervisord.conf


# Create the storage link
RUN php artisan storage:link

# Expose ports for Nginx and PHP-FPM
EXPOSE 80 9000

# Start supervisord to manage both Nginx and PHP-FPM
CMD ["supervisord", "-c", "/etc/supervisor/supervisord.conf"]
