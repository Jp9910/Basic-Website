FROM php:8.1-apache

COPY ./ /var/www/html/

COPY ./99-xdebug.ini /usr/local/etc/php/conf.d/99-xdebug.ini

RUN apt-get update && apt-get install -y vim iputils-ping net-tools

RUN docker-php-ext-install pdo pdo_mysql
    
RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN a2enmod rewrite

WORKDIR /var/www/html

#ENTRYPOINT ["service","apache2","start"]