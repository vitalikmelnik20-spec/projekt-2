FROM php:7.4-apache

# Allow .htaccess overrides and enable needed modules
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf \
    && a2enmod rewrite headers

# Install tools; libsqlite3-dev is required to compile pdo_sqlite.
# Chain MPM fix in the same layer: remove all mpm_* mods, restore only prefork.
RUN apt-get update \
    && apt-get install -y --no-install-recommends python3 sqlite3 libsqlite3-dev \
    && rm -rf /var/lib/apt/lists/* \
    && find /etc/apache2/mods-enabled/ -name 'mpm_*' -delete 2>/dev/null || true \
    && ln -sf /etc/apache2/mods-available/mpm_prefork.load /etc/apache2/mods-enabled/mpm_prefork.load \
    && ln -sf /etc/apache2/mods-available/mpm_prefork.conf /etc/apache2/mods-enabled/mpm_prefork.conf

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
