FROM php:7.4-fpm-alpine3.15

RUN apk add ssmtp bash

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions

RUN install-php-extensions mysqli intl gd zip mcrypt imagick memcached memcache pdo_mysql

#ADD conf/php.ini /usr/local/etc/php/php.ini
ADD conf/php.ini /usr/local/etc/php/php.ini
ADD conf/www.conf /usr/local/etc/php-fpm.d/www.conf
RUN sed -i -e "s/www-data:x:82:82:Linux User,,,:\/home\/www-data:\/sbin\/nologin/www-data:x:1000:1000:Linux User,,,:\/home\/www-data:\/bin\/bash/g" /etc/passwd
RUN sed -i -e "s/www-data:x:82:www-data/www-data:x:1000:www-data/g" /etc/group

RUN cd /bin && curl --silent --show-error https://getcomposer.org/installer | php && mv composer.phar composer && chmod 777 composer

WORKDIR /var/www/html

EXPOSE 9000
