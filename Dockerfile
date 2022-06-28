FROM prooph/php:7.4-fpm


RUN apk add --update --no-cache \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/bin/ --filename=composer

COPY . /var/www
COPY ./nginx/app-www.conf /etc/nginx/conf.d/app-www.conf

RUN echo 'xdebug.mode = coverage' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini;
WORKDIR /var/www