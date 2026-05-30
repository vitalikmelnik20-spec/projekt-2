FROM php:7.4-apache

# Enable Apache modules
RUN a2enmod rewrite headers

# Allow .htaccess to override all settings
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Install PHP extensions needed by the app
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy all app files into Apache document root
COPY . /var/www/html/

# Set proper file ownership
RUN chown -R www-data:www-data /var/www/html

# Copy startup script
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
