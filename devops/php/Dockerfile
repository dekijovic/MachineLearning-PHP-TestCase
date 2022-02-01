FROM php:8.1-fpm
RUN apt-get update && apt-get install -y libmagickwand-dev  --no-install-recommends && rm -rf /var/lib/apt/lists/* \
    git \
    zip \
    libonig-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libpq-dev \
    libxml2-dev \
    libzip-dev \
    libc6 \
    && printf "\n" | pecl install imagick \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd

#docker extensions
RUN docker-php-ext-install pdo_mysql mysqli bcmath pcntl mbstring


#enablers
RUN docker-php-ext-enable mysqli


#####################################
# Composer:
#####################################

# Install composer and add its bin to the PATH.
RUN curl -s http://getcomposer.org/installer | php && \
    echo "export PATH=${PATH}:/var/www/vendor/bin" >> ~/.bashrc && \
    mv composer.phar /usr/local/bin/composer

# Source the bash
RUN . ~/.bashrc
