FROM php:8.1-apache

COPY ./ /var/www/html/

COPY ./99-xdebug.ini /usr/local/etc/php/conf.d/99-xdebug.ini

# Setup composer and install dependencies
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN apt-get update && apt-get install -y vim iputils-ping net-tools

RUN docker-php-ext-install pdo pdo_mysql

RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN a2enmod rewrite

WORKDIR /var/www/html

RUN composer install --no-scripts && composer dump-autoload

#ENTRYPOINT ["service","apache2","start"]