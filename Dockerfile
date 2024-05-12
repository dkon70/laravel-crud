FROM php

RUN apt update && apt install -y libpq-dev  \
    && docker-php-ext-install pdo pdo_pgsql


WORKDIR /app

COPY . .

EXPOSE ${APP_PORT}

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${APP_PORT}
