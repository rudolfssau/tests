FROM php:8.1-fpm

RUN apt-get update && apt-get install -y libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl pdo pdo_mysql \
    && pecl install apcu \
    && apt-get install -y libprotobuf-dev protobuf-compiler \
    && apt-get install -y libboost-dev \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

WORKDIR /var/www/project
