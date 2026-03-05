FROM php:8.2-apache

# Enable Apache mod_rewrite for clean URLs
RUN a2enmod rewrite

# Install PHP extensions commonly needed for DB connectivity
RUN docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR /var/www/html

# Copy all project files
COPY . .

# Fix permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]