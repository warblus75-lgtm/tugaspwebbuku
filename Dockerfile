FROM php:8.4-cli

# Install system packages + Node.js
RUN apt-get update && apt-get install -y \
    git unzip zip curl libzip-dev \
    nodejs npm \
    && docker-php-ext-install zip pdo pdo_mysql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node dependencies
RUN npm install

# Build Vite
RUN npm run build

EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=8080