# Use the official PHP image as the base image
FROM php:8.0-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /var/www/html

# Copy the composer files to the container
COPY composer.json composer.lock ./

# Install project dependencies
RUN composer install

# Copy the rest of the application code to the container
COPY . .

# Install npm and Node.js
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs

# Install npm packages
RUN npm install

# Build the Vue.js frontend
RUN npm run production

# Expose the port the application runs on
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]
