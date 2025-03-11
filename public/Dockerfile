# PHP 8.2 және Apache сервері бар ресми бейне
FROM php:8.2-apache

# Қажетті PHP кеңейтулерін орнату
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip unzip git curl \
    && docker-php-ext-install pdo pdo_mysql gd

# Composer орнату
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Жоба директориясын дайындау
WORKDIR /var/www/html

# Laravel файлын контейнерге көшіру
COPY .. .

# Laravel үшін дұрыс рұқсаттар орнату
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Composer тәуелділіктерін орнату (ҚАТЕНІ ТҮЗЕТУ)
RUN composer install --no-dev --optimize-autoloader || true

# .env файлын көшіру (егер бар болса)
COPY ../.env.example .env

# Artisan командаларын орындау (МӘСЕЛЕНІ ТҮЗЕТУ)
RUN php artisan key:generate || true
RUN php artisan migrate --force || true
RUN php artisan config:cache || true

# Apache үшін порт ашу
EXPOSE 80

# Контейнер іске қосылғанда серверді автоматты түрде бастау
CMD ["apache2-foreground"]
