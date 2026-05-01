FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libsodium-dev \
    libicu-dev \
    default-mysql-client \
    default-libmysqlclient-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_pgsql pdo_mysql mbstring zip exif pcntl bcmath gd sodium intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN php artisan filament:assets
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - && apt-get install -y nodejs

WORKDIR /var/www/html

COPY . .

RUN composer install
RUN npm install

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
