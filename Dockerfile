FROM php:7.4-apache

# Enable Apache modules
RUN a2enmod rewrite headers

# Allow .htaccess overrides
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Install system tools and PHP extensions
RUN apt-get update && apt-get install -y python3 sqlite3 libsqlite3-dev --no-install-recommends \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install mysqli pdo pdo_mysql pdo_sqlite

# Copy app files
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html

# Copy and set up startup script
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
