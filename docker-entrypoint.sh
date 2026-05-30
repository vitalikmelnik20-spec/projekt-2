#!/bin/bash
set -e

# Railway provides PORT env var — configure Apache to listen on it
PORT=${PORT:-80}

sed -i "s/Listen 80/Listen $PORT/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:$PORT>/" /etc/apache2/sites-available/000-default.conf

exec "$@"
