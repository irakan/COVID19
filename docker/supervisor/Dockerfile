FROM php:8.1-cli

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# Installing dependencies
RUN apt-get update && apt-get install -y supervisor 

# Installing extensions
RUN install-php-extensions pdo_mysql bcmath redis pcntl

# Install redis
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

# Prepare log files
RUN touch /var/log/horizon.log
RUN touch /var/log/supervisord.log

# Add supervisor configuration
COPY /docker/supervisor/supervisord.conf /etc/supervisor/supervisord.conf

# Set up default directory
WORKDIR /etc/supervisor/conf.d/

# Run after container is up
CMD ["/usr/bin/supervisord","-n", "-c", "/etc/supervisor/supervisord.conf"]

