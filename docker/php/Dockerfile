FROM php:8.1-fpm

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# Installing dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    supervisor \
    zip \
    unzip \
    git \
    curl \
    openssl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Installing extensions
RUN install-php-extensions gd pdo_mysql mysqli redis imagick zip mbstring exif pcntl

# Installing composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install redis
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

# Changing Workdir
WORKDIR /var/www/html/backend

# Add user for laravel application
RUN groupadd --force -g 1000 www \
    && useradd -ms /bin/bash --no-log-init --no-user-group -g 1000 -u 1000 www

# Copy existing application directory contents
COPY . /var/www/html/backend

# Copy existing application directory permissions
COPY --chown=www:www . /var/www/html/backend

# Make sure files/folders needed by the processes are accessable when they run under the application user
RUN chown -R www:www /var/log/supervisor


# Change current user to www
USER www