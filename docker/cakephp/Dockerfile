FROM php:7-apache

RUN set -x && \
    apt-get -y update && apt-get install -y wget unzip libicu-dev libbz2-dev zlib1g-dev && NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) && \
    docker-php-ext-install -j${NPROC} bz2 intl zip  pdo_mysql && \
    rm -rf /tmp/pear

RUN apt-get update -qq && apt-get install -y libssl-dev libcurl4-openssl-dev apache2-dev libapr1-dev libaprutil1-dev libxml2 libxslt-dev patch apache2

RUN wget https://raw.githubusercontent.com/composer/getcomposer.org/1b137f8bf6db3e79a38a5bc45324414a6b1f9df2/web/installer -O - -q | php -- --quiet
RUN mv composer.phar /usr/local/bin/composer

RUN docker-php-ext-install pcntl

ENV APACHE_DOCUMENT_ROOT /var/www/html/app/webroot

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html/app
