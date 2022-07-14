FROM webdevops/php-nginx:8.1-alpine
ENV WEB_DOCUMENT_ROOT=/app/public

WORKDIR /app

# Copy existing application directory contents
COPY ../api/ .
COPY ../docker/php-nginx/etc/supervisor.d/* /opt/docker/etc/supervisor.d/

# Ensure all of our files are owned by the same user and group
RUN chown -R application:www-data /app
USER application

RUN composer install --no-interaction --optimize-autoloader --no-dev