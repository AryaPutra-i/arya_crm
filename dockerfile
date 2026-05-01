FROM php:8.5.5-cli

RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libzip-dev \
    libonig-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    libsodium-dev \
    default-mysql-client \
    default-libmysqlclient-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo-pgsql pdo_mysql mbstring zip exif pcntl bcmath gd zip sodium \

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -sl https://deb.nodesource.com/setup_18.x | bash - && apt-get install -y nodejs

WORKDIR /var/www/html

COPY . .

EXPOSE 8000

RUN composer install --ignore-platform-req=ext-intl --ignore-platform-req=ext-zip
RUN npm install

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000