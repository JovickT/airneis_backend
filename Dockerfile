FROM php:8.2-apache

# Define the working directory
WORKDIR /var/www/App

# Add the PHP extension installer and make it executable
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install required PHP extensions
RUN install-php-extensions pdo_mysql intl

# Install Composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    rm composer-setup.php

# Install Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash && \
    mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Copy application files
COPY . /var/www/App

# Install application dependencies
RUN composer install --no-scripts --no-autoloader

# Verify files and permissions before running Composer
RUN ls -la /var/www/App

# Configure Apache
# COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Expose port 80
EXPOSE 80

# Start Symfony server using Symfony CLI
CMD ["symfony", "server:ca:install"]
CMD ["symfony", "server:start", "--no-tls", "--port=80"]

