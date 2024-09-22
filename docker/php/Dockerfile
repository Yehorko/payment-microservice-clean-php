FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
#    sendmail \
    && docker-php-ext-install zip

# Check that SPL lib is activated (This lib is activated in PHP by default)
RUN php -m | grep SPL

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

RUN chown -R www-data:www-data /var/www

RUN git config --global --add safe.directory /var/www

CMD ["php-fpm"]