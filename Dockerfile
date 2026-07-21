# Stage 1: Build Dependencies
FROM composer:2.7 AS vendor

WORKDIR /app

# Copy dependency definitions
COPY composer.json composer.lock ./

# Install dependencies strictly without running scripts or autoloaders
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --ignore-platform-reqs \
    --no-scripts \
    --no-autoloader \
    --no-plugins

# Stage 2: Runtime Environment
FROM php:8.3-apache

# Install system packages & PHP extensions required by Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite module
RUN a2enmod rewrite

WORKDIR /var/www/html

# Copy application source code
COPY . .

# Copy installed vendor packages from Stage 1
COPY --from=vendor /app/vendor /var/www/html/vendor

# Copy Composer binary for runtime execution
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Clear old cached package files and generate production autoloader
RUN rm -f bootstrap/cache/*.php && composer dump-autoload --optimize --no-dev --classmap-authoritative

# Set permissions for Laravel storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Point Apache DocumentRoot to /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/conf-available/*.conf

# Apache directory overrides
RUN printf '<Directory /var/www/html/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>\n' >> /etc/apache2/apache2.conf

EXPOSE 80

CMD ["/bin/bash", "-c", "php artisan config:clear && php artisan migrate --force && apache2-foreground"]