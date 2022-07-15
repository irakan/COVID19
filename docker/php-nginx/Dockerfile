FROM webdevops/php-nginx:8.1-alpine
ENV WEB_DOCUMENT_ROOT=/app/public

USER application:application

WORKDIR /app

RUN mkdir -p storage/app/public \
    storage/logs \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/testing \
    storage/framework/views

# Copy existing application directory contents
COPY --chown=application ./api/ .
COPY ../docker/php-nginx/etc/supervisor.d/* /opt/docker/etc/supervisor.d/


RUN composer install --no-interaction --optimize-autoloader --no-dev

# Ensure all of our files are owned by the same user and group
USER application