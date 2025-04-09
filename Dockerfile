# Dockerfile
FROM php:8.3-fpm

# Set working directory
WORKDIR /var/www/html

RUN git config --global --add safe.directory /var/www/html


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
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql intl zip opcache

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-progress --no-interaction

# Install Node.js & build assets
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && npm install && npm run build

# Schedule Laravel cron
RUN echo "* * * * * cd /var/www/html && php artisan schedule:run >> /dev/null 2>&1" | crontab -

EXPOSE 9000

CMD ["php-fpm"]
