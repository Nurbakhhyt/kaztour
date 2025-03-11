# PHP 8.2 және Apache сервері бар ресми бейне
FROM php:8.2-apache

# Қажетті PHP кеңейтулерін орнату
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip unzip git curl \
    && docker-php-ext-install pdo pdo_mysql gd

# Composer орнату
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Laravel үшін жұмыс директориясын орнату
WORKDIR /var/www/html

# Laravel файлын контейнерге көшіру
COPY . .

# ✅ **Apache конфигурациясын дұрыс орнату**
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Laravel үшін дұрыс рұқсаттар орнату
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# ✅ **Composer тәуелділіктерін орнату**
RUN composer install --no-dev --optimize-autoloader || true

# ✅ **Laravel конфигурациясы**
COPY .env.example .env
RUN php artisan key:generate || true
RUN php artisan migrate --force || true
RUN php artisan config:cache || true

# Storage және bootstrap/cache папкаларына рұқсат беру
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache
# Apache үшін порт ашу
EXPOSE 80

# Контейнер іске қосылғанда серверді автоматты түрде бастау
CMD ["apache2-foreground"]
