FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev git unzip libzip-dev libicu-dev \
    && docker-php-ext-install pdo pdo_pgsql zip bcmath intl

RUN git config --global --add safe.directory /var/www/html

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer


WORKDIR /var/www/html

COPY . .

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN chown -R www-data:www-data storage bootstrap/cache

CMD php artisan serve --host=0.0.0.0 --port=8001
