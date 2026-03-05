FROM php:8.2-apache

# Enable Apache mod_rewrite for clean URLs
RUN a2enmod rewrite

# Install PHP extensions commonly needed for DB connectivity
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Move Apache from port 80 → port 3000 (AutoFlow expects 3000)
RUN sed -i 's/Listen 80/Listen 3000/' /etc/apache2/ports.conf && \
    sed -i 's/<VirtualHost \*:80>/<VirtualHost *:3000>/' /etc/apache2/sites-enabled/000-default.conf

WORKDIR /var/www/html

# Copy all project files
COPY . .

# Fix permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 3000
CMD ["apache2-foreground"]