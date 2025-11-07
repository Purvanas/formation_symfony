# 1) Base PHP-FPM
FROM php:8.2-fpm

# 2) Dépendances systèmes et extensions PHP
RUN apt-get update && apt-get install -y \
    git zip unzip libicu-dev libonig-dev libxml2-dev libzip-dev \
    dos2unix \
  && docker-php-ext-install intl pdo_mysql xml zip opcache

# 3) Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4) Définir le répertoire de travail
WORKDIR /var/www

# 5) Copier tous les fichiers de l’app
COPY . .

# 6) Convertir les scripts en LF pour éviter php\r
RUN dos2unix bin/console \
 && dos2unix vendor/bin/* || true

# 7) Installer les dépendances PHP
RUN composer install --no-interaction --optimize-autoloader

# 8) Ajuster les permissions
RUN chown -R www-data:www-data var vendor
