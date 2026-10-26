FROM php:8.2-cli

# Dépendances système
RUN apt-get update && apt-get install -y \
    git zip unzip nodejs npm \
    libzip-dev libpng-dev libonig-dev libxml2-dev \
    sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip gd mbstring

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Code
COPY . .

# Crée la base SQLite + droits + .env si manquant
RUN touch database/database.sqlite \
    && mkdir -p storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache database \
    && if [ ! -f .env ]; then cp .env.example .env; fi

# Dépendances PHP et Node
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Port Render
EXPOSE 10000

# Au démarrage : migrate + seed + lance le serveur
CMD sh -c "php artisan config:clear && php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=10000"