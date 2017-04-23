FROM php:7.0-apache
COPY / /var/www/html

RUN apt-get update
RUN apt-get install -y libmcrypt-dev zip unzip curl
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install mbstring pdo pdo_mysql mcrypt
RUN a2enmod rewrite && service apache2 restart