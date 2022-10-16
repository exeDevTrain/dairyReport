FROM composer:2.4 as composer

ENV COMPOSER_ALLOW_SUPERUSER=1 \
	COMPOSER_HOME=/composer


FROM node:16.17-bullseye-slim as node


FROM php:8.1.0-fpm-bullseye as base
WORKDIR /var/www/backend

RUN apt-get update \
  && apt-get install --no-install-recommends -y \
    git \
    unzip \
    libicu-dev \
    libzip-dev \
  && apt-get clean \
  && docker-php-ext-install \
    intl \
    pdo_mysql \
    zip bcmath \
  && rm -rf /var/lib/apt/lists/*


# 最終イメージ
FROM base
SHELL ["/bin/bash", "-oeux", "pipefail", "-c"]
WORKDIR /var/www/backend

# マルチステージビルドでphp-fpmコンテナにcomposerとyarnを追加する
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=node /usr/local/bin /usr/local/bin
COPY --from=node /usr/local/lib/node_modules/npm /usr/local/lib/node_modules/npm

COPY ./infra/docker/php/php-fpm.d/zzz-www.conf /usr/local/etc/php-fpm.d/zzz-www.conf
COPY ./infra/docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./infra/docker/php/php.ini /usr/local/etc/php/php.ini

ARG GROUP_ID ${GROUP_ID} \
    GROUP_NAME ${GROUP_NAME} \
    USER_ID ${USER_ID} \
    USER_NAME ${USER_NAME}

RUN groupadd -g $GROUP_ID $GROUP_NAME \
  && useradd -m -s /bin/bash -l -u $USER_ID -g $GROUP_ID $USER_NAME \
  && chown -R $USER_NAME:$GROUP_NAME /var/www/ \
  && chmod +x /var/www/ \
  && mkdir /var/run/php-fpm \
  && chown -R $USER_NAME:$GROUP_NAME /var/www/ \
  && chown -R $USER_NAME:$GROUP_NAME /var/run/ \
  && chown -R $USER_NAME:$GROUP_NAME /var/log/

USER $USER_NAME