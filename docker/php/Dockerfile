FROM php:7.3-fpm

# install composer
RUN unlink /usr/bin/composer
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
    && docker-php-ext-install pdo_mysql pdo_pgsql

WORKDIR /var/www/html

