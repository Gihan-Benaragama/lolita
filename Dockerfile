# ---- Stage 1: build frontend assets (Tailwind/Vite) with Node ----
FROM node:20-alpine AS assets
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# ---- Stage 2: the actual PHP app, on a properly maintained, current image ----
FROM serversideup/php:8.4-fpm-nginx

# This image runs as a non-root user by default; USER root lets us install
# deps and set permissions before dropping back to the safe default user.
USER root

ENV NGINX_WEBROOT=/var/www/html/public
ENV PHP_OPCACHE_ENABLE=1
ENV SSL_MODE=off

# --- Laravel automations built into this image ---
# These replace the manual deploy script we needed with the old base image.
ENV AUTORUN_ENABLED=true
ENV AUTORUN_LARAVEL_MIGRATION=true
ENV AUTORUN_LARAVEL_STORAGE_LINK=true

WORKDIR /var/www/html
COPY . .

# Bring in the frontend assets built in Stage 1
COPY --from=assets /app/public/build ./public/build

RUN composer install --no-dev --optimize-autoloader --no-interaction

# SQLite lives as a plain file inside the container — make sure it exists
# and is writable by the user this image actually runs as (www-data).
RUN mkdir -p database \
    && touch database/database.sqlite \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 database storage bootstrap/cache

# Custom startup hook — runs automatically after the image's own AUTORUN
# migration step, per this image's documented extension pattern.
COPY --chmod=755 docker/entrypoint.sh /etc/entrypoint.d/99-app-init.sh

EXPOSE 8080