############################
# Stage 1 - Build Frontend #
############################
FROM node:20 AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build


############################
# Stage 2 - PHP / Laravel  #
############################
FROM php:8.2-apache

# Install system packages
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    && rm -rf /var/lib/apt/lists/*

# Configure GD
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg

# Install PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mysqli \
    gd \
    mbstring \
    zip \
    exif \
    intl \
    bcmath

# Enable rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy Laravel project
COPY . .

# Copy compiled frontend
COPY --from=frontend /app/public/build ./public/build

# Install PHP packages
RUN composer install \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --no-interaction

# Storage folders
RUN mkdir -p storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Apache configuration
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' \
/etc/apache2/sites-available/000-default.conf

RUN printf '<Directory /var/www/html/public>\n\
AllowOverride All\n\
Require all granted\n\
</Directory>\n' \
>> /etc/apache2/apache2.conf

# Startup script
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 80

CMD ["/usr/local/bin/start.sh"]