FROM php:7.3-apache

EXPOSE 80
COPY src /var/www/html
RUN apt-get update
RUN apt-get install -y git nano
RUN pecl install -f xdebug \
&& echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
&& echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
# && echo "xdebug.remote_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini \
&& echo "xdebug.remote_host=192.168.1.192" >> /usr/local/etc/php/conf.d/xdebug.ini \
&& echo "xdebug.idekey=VSCODE" >> /usr/local/etc/php/conf.d/xdebug.ini
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite
# RUN chown -R www-data:www-data ./ && a2enmod rewrite
