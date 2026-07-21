FROM php:8.2-apache

# Install system dependencies & PHP extensions required by Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd

# Enable Apache mod_rewrite module
RUN a2enmod rewrite

# Set working directory inside container
WORKDIR /var/www/html

# Get latest Composer executable
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy composer definition files first for layer caching
COPY composer.json composer.lock ./

# Install PHP dependencies with safety flags to prevent interactive crashes or audit failures
ENV COMPOSER_MEMORY_LIMIT=-1
RUN composer install \
    --no-dev \
    --no-scripts \
    --no-autoloader \
    --ignore-platform-reqs \
    --no-interaction \
    --prefer-dist \
    --no-audit

# Copy the rest of the application files
COPY . .

# Generate optimized autoloader after source code is copied
RUN composer dump-autoload --optimize --no-dev

# Set proper ownership for storage and cache directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Point Apache document root to Laravel's /public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/conf-available/*.conf

# Configure directory permissions for Apache
RUN printf '<Directory /var/www/html/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>\n' >> /etc/apache2/apache2.conf

EXPOSE 80

CMD ["apache2-foreground"]