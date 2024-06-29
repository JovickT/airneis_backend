FROM php:8.2-apache

# Ajouter l'installateur d'extensions PHP et le rendre exécutable
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Installer les extensions PHP nécessaires
RUN install-php-extensions pdo_mysql intl

# Installer Composer
RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
    mv composer.phar /usr/local/bin/composer

# Installer Node.js et npm
RUN apt update && apt install -yqq nodejs npm

# Copier les fichiers de l'application Symfony dans le conteneur
COPY . /var/www/

COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Définir le répertoire de travail
WORKDIR /var/www/

RUN composer install --no-scripts --no-autoloader

EXPOSE 80
