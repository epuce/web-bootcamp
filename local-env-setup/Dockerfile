# TODO add unit test setup and create php router
# Improve the build to be fool proof
FROM php:7.3-apache

EXPOSE 80
RUN mkdir -p src
COPY ./src /var/www/html
RUN apt-get update
RUN apt-get install -y git nano wget gnupg nodejs
RUN curl -L https://npmjs.org/install.sh | sh

# Install mongodb
RUN wget -qO - https://www.mongodb.org/static/pgp/server-4.2.asc | apt-key add -
RUN echo "deb [ arch=amd64,arm64 ] https://repo.mongodb.org/apt/ubuntu bionic/mongodb-org/4.2 multiverse" | tee /etc/apt/sources.list.d/mongodb-org-4.2.list
RUN apt-get update
RUN apt-get install -y mongodb-org
RUN mkdir -p /data/db

# Install xdebug
RUN pecl install -f xdebug \
&& echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
&& echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
&& echo "xdebug.remote_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini \
# && echo "xdebug.remote_host=192.168.2.192" >> /usr/local/etc/php/conf.d/xdebug.ini \
&& echo "xdebug.remote_port=9001" >> /usr/local/etc/php/conf.d/xdebug.ini \
&& echo "xdebug.idekey=VSCODE" >> /usr/local/etc/php/conf.d/xdebug.ini

# Install SQL db
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Allow external user to be the owner
RUN chmod -R 777 ./
RUN a2enmod rewrite
