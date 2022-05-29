FROM ubuntu:20.04
MAINTAINER MarcinRadwan

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && \
    apt-get -y install software-properties-common && \
    add-apt-repository ppa:ondrej/php && \
    apt-get update && \
    apt-get -y install supervisor git webp curl unzip apache2 php7.4 && \
    # php 7.4 extensions
    apt-get -y install php7.4-mysql php7.4-mbstring php7.4-gd php7.4-intl php7.4-xsl  && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# RUN apt-get update && apt-get install -y software-properties-common && add-apt-repository ppa:ondrej/php && apt-get update

# RUN apt-get update && apt-get -y install libapache2-mod-php php-curl

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid
ENV APACHE_RUN_DIR /var/run/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_LOG_DIR /var/log/apache2

COPY ./apache2.conf /etc/apache2/apache2.conf
COPY ./php.ini /etc/php/7.4/cli/php.ini
COPY ./composer.phar /usr/local/bin/composer

RUN chmod 777 /usr/local/bin/composer

# config to enable .htaccess
RUN a2enmod rewrite

# enable modules: headers & expires
RUN a2enmod headers
RUN a2enmod expires

RUN usermod -u 1000 www-data

CMD ["apache2","-D","FOREGROUND"]
RUN php --version
