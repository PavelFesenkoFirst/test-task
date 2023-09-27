FROM php:8.1-fpm-buster

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    sqlite3 \
    libsqlite3-dev

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql pdo_sqlite zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV PATH="/root/.composer/vendor/bin:${PATH}"

RUN composer global require laravel/installer

WORKDIR /var/www

EXPOSE 9000

CMD ["php-fpm"]