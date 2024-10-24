# Use official PHP 8.2 image with FPM
FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql zip gd

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy all files to the container
COPY . .

# Install PHP dependencies using composer
RUN composer install --prefer-dist --no-scripts --no-dev --optimize-autoloader

RUN composer dump

RUN php artisan server


# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www

# Expose the necessary ports for the app
EXPOSE 8000

# Start PHP-FPM server
CMD ["php-fpm"]
