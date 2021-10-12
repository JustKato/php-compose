FROM php:8.0-apache

# Label yourself here if you are going to publish an image
LABEL maintainer="Kato <contact@justkato.me>"

# Basic apt updates
RUN apt-get update
RUN apt-get upgrade -y

# Installing necessary components for PHP
RUN apt-get install --fix-missing -y libpq-dev
RUN apt-get install --no-install-recommends -y libpq-dev
RUN apt-get install -y libxml2-dev libbz2-dev zlib1g-dev
RUN apt-get -y install libsqlite3-dev libsqlite3-0 mariadb-client curl exif ftp
RUN apt-get update -y && apt-get install -y libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev \
    libfreetype6-dev
RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev 

RUN docker-php-ext-install intl
RUN docker-php-ext-install mysqli pdo pdo_mysql
# RUN docker-php-ext-install mbstring
RUN docker-php-ext-configure gd --with-freetype
RUN docker-php-ext-install gd

# Imagick
RUN apt-get update && apt-get install -y \
    libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
	&& docker-php-ext-enable imagick

RUN apt-get -y install --fix-missing git zip unzip

# Composer Install
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer self-update --2
# Apache2 Config
ADD conf/apache.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite
# Copy the startup script
COPY StartScript.sh /StartScript.sh
# Make the startup script runnable
RUN chmod +x /StartScript.sh

# Start setting up the public folder
RUN cd /var/www/html
RUN mkdir /var/www/html/public \
    && chmod -R 0777 /var/www/html/

# Clean apt-get
RUN apt-get clean \
    && rm -r /var/lib/apt/lists/*

# Expose the apache2 HTTP port
EXPOSE 80

# Expose certain paths
VOLUME ["/var/www/html", "/var/log/apache2", "/etc/apache2"]

# Run the startup script
CMD ["bash", "/StartScript.sh"]