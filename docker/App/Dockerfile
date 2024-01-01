FROM php:8.2.13-apache-bullseye as base

WORKDIR /var/www/html

COPY . .

#todo idk but copying everything is
#COPY src src/
#COPY autoload.php ./
#COPY cli.php ./
#COPY tests tests/

# change index.php root
ENV APACHE_DOCUMENT_ROOT /var/www/html/src
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN a2enmod rewrite


RUN apt-get update && apt-get install -y    \
    curl                                    \
    git                                     \
    nano                                    \
    unzip                                   \
    vim                                     \
    wget                                    \
    jq                                      \
    default-mysql-client                    \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# composer
ENV COMPOSER_INSTALLER_GIT_HASH da0a3a5b5c1c9d50f1d0115e7008018597dd3803
ENV COMPOSER_INSTALLER_SHA384_CHECKSUM 906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8
ENV COMPOSER_VERSION 2.2.6
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
RUN curl \
    --silent \
    --connect-timeout 10 \
    --max-time 10 \
    --retry 5 \
    --retry-delay 0 \
    --retry-max-time 60 \
    --output composer-setup.php \
    "https://raw.githubusercontent.com/composer/getcomposer.org/${COMPOSER_INSTALLER_GIT_HASH}/web/installer"
RUN php -r "if (hash_file('SHA384', 'composer-setup.php') === '${COMPOSER_INSTALLER_SHA384_CHECKSUM}') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php --install-dir /usr/local/bin/ --filename composer --version $COMPOSER_VERSION && \
    php -r "unlink('composer-setup.php');"

#PDO
RUN docker-php-ext-install pdo pdo_mysql

FROM base as dev

ENV XDEBUG_VERSION="3.2.2"
RUN pecl install xdebug-${XDEBUG_VERSION} && docker-php-ext-enable xdebug
COPY docker/App/xdebug/rootfs/ /
