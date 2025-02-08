FROM php:8.1-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    cron \
    supervisor \
    && docker-php-ext-install pdo pdo_mysql

# Copy application files
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install Composer dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev

# Install Node.js dependencies and build assets
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs
RUN npm install
RUN npm run build

# Configure cron job
RUN echo "* * * * * cd /var/www/html && php artisan schedule:run >> /dev/null 2>&1" > /etc/cron.d/laravel-scheduler
RUN chmod 0644 /etc/cron.d/laravel-scheduler
RUN crontab /etc/cron.d/laravel-scheduler

# Configure supervisor to manage cron
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expose port 9000 and start supervisor
EXPOSE 9000
CMD ["/usr/bin/supervisord"]