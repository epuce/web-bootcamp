FROM php:8.3-apache

EXPOSE 80

COPY ./src/ /var/www/html/

# System tools + Node.js 20 LTS (so npm builds can run inside the container)
RUN apt-get update \
    && apt-get install -y --no-install-recommends git nano wget curl gnupg unzip ca-certificates \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y --no-install-recommends nodejs \
    && rm -rf /var/lib/apt/lists/*

# PHP extensions for MySQL access
RUN docker-php-ext-install pdo_mysql mysqli

# Xdebug 3 (the client_* / mode keys replaced the old Xdebug 2 remote_* ones)
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && { \
        echo "xdebug.mode=debug"; \
        echo "xdebug.client_host=host.docker.internal"; \
        echo "xdebug.client_port=9003"; \
        echo "xdebug.start_with_request=yes"; \
        echo "xdebug.idekey=VSCODE"; \
    } >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN a2enmod rewrite
