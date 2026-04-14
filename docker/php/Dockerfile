FROM php:8.4-fpm

# create a stable temp directory
RUN mkdir -p /tmp/php && chmod 777 /tmp/php

# set environment variable
ENV TMPDIR=/tmp/php

# system deps
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev

# PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www