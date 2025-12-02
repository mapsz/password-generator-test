ARG PHP_TAG=8.5-fpm
FROM php:${PHP_TAG}

# System deps and PHP extensions commonly needed by Symfony
RUN apt-get update && apt-get install -y \
    curl \
    ca-certificates \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    zlib1g-dev \
    libxml2-dev \
    libonig-dev \
    libpq-dev \
  && docker-php-ext-configure intl \
  && docker-php-ext-install -j$(nproc) intl pdo_pgsql zip \
  && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash \
  && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# PHP config
COPY docker/php/php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www
