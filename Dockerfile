FROM php:7.3.8-fpm-alpine
RUN apk add --no-cache openssl bash mysql-client icu icu-dev icu-libs libpng libpng-dev zip libzip libzip-dev
RUN docker-php-ext-configure zip --with-libzip
RUN docker-php-ext-install pdo pdo_mysql intl gd zip

ENV DOCKERIZE_VERSION v0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz


#COPY .docker ./.docker

WORKDIR /var/www
RUN rm -rf /var/www/html
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 9000
ENTRYPOINT ["php-fpm"]

