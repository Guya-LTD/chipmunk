# FROM php:8.0-rc-fpm-alpine AS production

FROM composer:2.0 AS production

# Create app directory
ENV WORK_DIR /usr/src/app
WORKDIR ${WORK_DIR}

COPY . ./

RUN composer install

CMD symfony server:start