FROM php

RUN apt update && apt install -y libpq-dev unzip \
    && docker-php-ext-install pdo pdo_pgsql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


WORKDIR /app

COPY . .

EXPOSE ${APP_PORT}

CMD composer install && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${APP_PORT}
