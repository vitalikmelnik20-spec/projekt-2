#!/bin/bash
set -e

# Ensure only mpm_prefork is loaded (mod_php requires it; event/worker conflict with it).
# Use find -delete to catch any naming variation, then force-symlink prefork.
find /etc/apache2/mods-enabled/ -name 'mpm_*' -delete 2>/dev/null || true
ln -sf /etc/apache2/mods-available/mpm_prefork.load /etc/apache2/mods-enabled/mpm_prefork.load
ln -sf /etc/apache2/mods-available/mpm_prefork.conf /etc/apache2/mods-enabled/mpm_prefork.conf

PORT=${PORT:-80}
SQLITE_PATH=${SQLITE_PATH:-/data/game.db}

# Configure Apache to listen on Railway's PORT
sed -i "s/Listen 80/Listen $PORT/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:$PORT>/" /etc/apache2/sites-available/000-default.conf

# Initialize SQLite database on first run
SCHEMA_VERSION="3"
SCHEMA_MARKER="${SQLITE_PATH}.v${SCHEMA_VERSION}"

mkdir -p "$(dirname "$SQLITE_PATH")"
chown www-data:www-data "$(dirname "$SQLITE_PATH")"
chmod 775 "$(dirname "$SQLITE_PATH")"

if [ ! -f "$SQLITE_PATH" ] || [ ! -f "$SCHEMA_MARKER" ]; then
    echo "Initializing database (schema v${SCHEMA_VERSION})..."
    rm -f "$SQLITE_PATH"
    python3 /var/www/html/convert_db.py /var/www/html/sql.sql /tmp/game_init.sql
    sqlite3 "$SQLITE_PATH" < /tmp/game_init.sql
    rm -f /tmp/game_init.sql
    touch "$SCHEMA_MARKER"
    echo "Database ready at $SQLITE_PATH"
fi

chown www-data:www-data "$SQLITE_PATH"
chmod 664 "$SQLITE_PATH"

exec "$@"
