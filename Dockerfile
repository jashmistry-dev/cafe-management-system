# ---------- Build Stage ----------
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    nodejs \
    npm \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    libpq-dev

# Configure & install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN docker-php-ext-install \
    gd \
    pdo \
    pdo_mysql \
    mysqli \
    mbstring \
    exif \
    zip \
    intl \
    bcmath

# Enable Apache Rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy composer files first (better Docker cache)
COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --prefer-dist

# Copy remaining project files
COPY . .

# Install Node packages & build assets
RUN npm install
RUN npm run build

# Create Laravel directories
RUN mkdir -p storage/framework/cache
RUN mkdir -p storage/framework/sessions
RUN mkdir -p storage/framework/views
RUN mkdir -p storage/logs

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Apache Virtual Host
RUN echo '<VirtualHost *:80>\
DocumentRoot /var/www/html/public\
<Directory /var/www/html/public>\
AllowOverride All\
Require all granted\
</Directory>\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

EXPOSE 80

RUN chmod +x start.sh

CMD ["./start.sh"]