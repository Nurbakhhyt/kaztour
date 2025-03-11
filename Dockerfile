# PHP 8.2 және Apache сервері бар ресми бейне
FROM php:8.2-apache

# Қажетті PHP кеңейтулерін орнату
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip unzip git curl \
    && docker-php-ext-install pdo pdo_mysql gd

# Composer орнату
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Жоба директориясын дайындау
WORKDIR /var/www/html

# Laravel файлын контейнерге көшіру
COPY . .

# Composer тәуелділіктерін орнату
RUN composer install --no-dev --optimize-autoloader \
    && php artisan migrate --force \
    && php artisan config:cache

# Laravel үшін дұрыс рұқсаттар орнату
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Apache үшін порт ашу
EXPOSE 80

# Контейнер іске қосылғанда серверді автоматты түрде бастау
CMD ["apache2-foreground"]
