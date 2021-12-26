FROM php:8.1.1-cli-buster


# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    git \
    unzip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN pecl install -o -f redis xdebug \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN mkdir -p /srv/api

WORKDIR /srv/api