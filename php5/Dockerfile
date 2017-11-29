FROM php:5.6-fpm
MAINTAINER lxiao
COPY config/php.ini /usr/local/etc/php/

RUN apt-get update && apt-get install -y libpng12-dev libjpeg-dev libssl-dev \
  && rm -rf /var/lib/apt/lists/* \
  && docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr \
  && docker-php-ext-install gd mysqli pdo_mysql zip

RUN pecl install redis-3.1.0 \
	&& pecl install xdebug-2.5.0 \
	&& docker-php-ext-enable redis xdebug  

Run pecl install memcache-3.0.8 \
	&& docker-php-ext-enable memcache

Run pecl install mongo-1.6.16 \
	&& docker-php-ext-enable mongo
Run pecl install swoole \
	&& docker-php-ext-enable swoole

