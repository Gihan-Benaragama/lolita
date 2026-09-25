FROM richarvey/nginx-php-fpm:3.1.6

COPY . .

ENV WEBROOT=/var/www/html/public
ENV PHP_ERRORS_STDERR=1
ENV RUN_SCRIPTS=1
ENV REAL_IP_HEADER=1
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr
ENV DB_CONNECTION=sqlite

RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN npm install && npm run build

RUN mkdir -p /var/www/html/database && touch /var/www/html/database/database.sqlite
RUN chmod -R 775 /var/www/html/database /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod +x /var/www/html/scripts/00-laravel-deploy.sh

# No custom CMD — this image's own entrypoint runs automatically and,
# because RUN_SCRIPTS=1, it executes scripts/00-laravel-deploy.sh
# (below) before starting nginx+php-fpm. This is the documented hook
# for this specific base image, not a guess at its internals.
