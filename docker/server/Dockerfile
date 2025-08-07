FROM php:8.2-apache-bookworm

# Arquivo de configuração PHP
COPY php/90-php.ini /usr/local/etc/php/conf.d

# Instalação de Composer
RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer

# Install necessary build tools
RUN apt-get update && apt-get install -y \
    gcc \
    make \
    autoconf \
    && rm -rf /var/lib/apt/lists/*

# Install required extensions and dependencies
RUN apt-get update && apt-get install -y \
    libbz2-dev \
    libcurl4-openssl-dev \
    libxml2-dev \
    mariadb-client \
    libssl-dev \
    libldap-dev \
    libpcre3-dev \
    libmariadb-dev \
    libonig-dev \
    libpng-dev \
    libjpeg-dev \
    libzip-dev \
    zip \
    unzip \
    libicu-dev \
    libldap2-dev \
    libgd-dev \
    libpq-dev \
    libmcrypt-dev
# Remove default PHP extensions
RUN docker-php-ext-install -j$(nproc) \
    mysqli \
    pdo_mysql \
    ctype \
    soap \
    session \
    dom
# Install additional PHP extensions
RUN docker-php-ext-install -j$(nproc) \
    bcmath \
    zip \
    intl \
    gd \
    bz2 \
    mbstring \
    pgsql \
    opcache \
    calendar

# Enable MCRYPT extension
RUN pecl install mcrypt && docker-php-ext-enable mcrypt;

# Enable CALENDAR extension
RUN docker-php-ext-configure calendar && docker-php-ext-install calendar

# Enable LDAP extension
RUN docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    && docker-php-ext-install ldap

# Enable GD extension
RUN apt-get update && apt-get install -y \
    libfreetype-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Disable exposing server information
RUN sed -ri -e 's!expose_php = On!expose_php = Off!g' $PHP_INI_DIR/php.ini-production
RUN sed -ri -e 's!ServerTokens OS!ServerTokens Prod!g' /etc/apache2/conf-available/security.conf
RUN sed -ri -e 's!ServerSignature On!ServerSignature Off!g' /etc/apache2/conf-available/security.conf
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Set the Apache document root
ENV APACHE_DOCUMENT_ROOT=/var/www/html/
RUN chown -R www-data:www-data /var/www/html
RUN chmod 777 -R /var/www/html

# COPY host
#COPY hosts/hosts_local /etc/hosts

# COPY Apache modules
COPY ssl/marartti.crt /etc/ssl/certs
COPY ssl/marartti.key /etc/ssl/private

RUN a2enmod rewrite
RUN a2enmod ssl 
#RUN a2enmod ssl \
#   openssl req -subj '/CN=marartti.org.br/O=MarArtTI - Art em TI./C=BR' -new -newkey rsa:2048 -days 365 -nodes -x509 -keyout /etc/ssl/private/ssl-cert-snakeoil.key -out /etc/ssl/certs/ssl-cert-snakeoil.pem
RUN a2disconf other-vhosts-access-log
RUN service apache2 restart

# COPY Apache virtual host
COPY server_local/sites-available /etc/apache2/sites-available

RUN a2dissite 000-default.conf
RUN service apache2 restart
RUN a2ensite mcmv.conf default-ssl.conf
RUN service apache2 restart

# imagick
RUN apt-get update; \
    apt-get install -y libmagickwand-dev; \
    pecl install imagick; \
    docker-php-ext-enable imagick;

# xdebug
COPY php/90-xdebug.ini /usr/local/etc/php/conf.d
COPY php/xdebug.log /var/log
#RUN pecl install xdebug && docker-php-ext-enable xdebug
COPY php/xdebug-3.4.0.tgz /tmp/
RUN cd /tmp && tar -xzvf xdebug-3.4.0.tgz && \
    cd xdebug-3.4.0 && \
    phpize && \
    ./configure && \
    make && \
    make install

RUN docker-php-ext-enable xdebug

# Configuração de fuso horário
RUN ln -sf  /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime

# Expose ports
EXPOSE 80
EXPOSE 443

# Start Apache in the foreground
CMD ["apache2ctl", "-D", "FOREGROUND"]
