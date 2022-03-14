FROM php:7.4-apache


WORKDIR /app

RUN apt update

RUN apt install -y git libzip-dev zip && \
    docker-php-ext-install zip mysqli pdo pdo_mysql && \
    docker-php-ext-enable pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite

RUN rm -rf /var/www/html && \
    ln -s /app/public /var/www/html

RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN echo "xdebug.mode=off" | tee -a /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini > /dev/null && \
    echo "xdebug.start_with_request=yes" | tee -a /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini > /dev/null && \
    echo "xdebug.client_host=host.docker.internal" | tee -a /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini > /dev/null


COPY . .
RUN composer install

# Make storage folder and give access to www-data
RUN mkdir -p /app/storage && \
    chmod -R ugo+rw /app/storage && \
    chown -R www-data:www-data /app/storage
