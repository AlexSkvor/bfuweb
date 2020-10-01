FROM php:7.2-fpm
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli
RUN apt-get update -y && apt-get install -y sendmail libpng-dev
RUN apt-get update -y && apt-get install -y zlib1g-dev
RUN docker-php-ext-install mbstring && docker-php-ext-enable mbstring
RUN docker-php-ext-install gd &&docker-php-ext-enable gd