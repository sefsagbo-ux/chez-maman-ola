FROM php:8.2-cli
RUN apt-get update && apt-get install -y git zip unzip nodejs npm libzip-dev libpng-dev && docker-php-ext-install zip pdo pdo_mysql gd
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /app
COPY . .
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build
CMD php artisan serve --host=0.0.0.0 --port=10000
EXPOSE 10000