FROM php:8.1-apache-bullseye

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

COPY --from=composer:2.5.8 /usr/bin/composer /usr/bin/composer

RUN apt-get update -y \
    && apt-get install -y \
    	libgmp-dev \
    	libzip-dev \
    && docker-php-ext-install gmp \
    && docker-php-ext-install zip \
    && docker-php-ext-install mysqli
