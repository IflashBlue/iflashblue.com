# Start with the base image
FROM php:8.2-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libicu-dev \
    git \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql zip intl

# Enable Apache mod_rewrite for Symfony
RUN a2enmod rewrite

# Copy the virtual host configuration (we'll create this next)
COPY ./my-symfony.conf /etc/apache2/sites-available/000-default.conf

# permissions
RUN chown -R www-data:www-data /var/www/html
