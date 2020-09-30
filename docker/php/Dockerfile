FROM php:7.3-fpm

# install composer
#RUN unlink /usr/bin/composer
RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer
# install etc
RUN apt-get update \
&& apt-get install -y \
git \
zip \
unzip \
vim
# install nodebrew+node
SHELL ["/bin/bash", "-c"]
ENV NODE_VERSION v14.12.0
RUN curl -L git.io/nodebrew | perl - setup
RUN echo 'export PATH=$HOME/.nodebrew/current/bin:$PATH' >> $HOME/.bashrc
RUN source $HOME/.bashrc && nodebrew install-binary $NODE_VERSION
RUN source $HOME/.bashrc && nodebrew use $NODE_VERSION

RUN apt-get update \
    && apt-get install -y libpq-dev \
    && pecl install xdebug \
    && docker-php-ext-install pdo_mysql pdo_pgsql \
    && docker-php-ext-enable xdebug

RUN echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \ 
     && echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
     && echo "xdebug.remote_autostart=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
     && echo "xdebug.remote_connect_back = 1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
     && echo "xdebug.profiler_enable = 1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
     && echo "xdebug.remote_host =localhost" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
     && echo "xdebug.remote_port=9000" >>  /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

WORKDIR /var/www/html

