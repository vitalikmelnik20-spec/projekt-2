#!/bin/bash
set -e

# Fix Apache MPM conflict at runtime (runs every start, not affected by Docker cache)
rm -f /etc/apache2/mods-enabled/mpm_event.conf \
      /etc/apache2/mods-enabled/mpm_event.load \
      /etc/apache2/mods-enabled/mpm_worker.conf \
      /etc/apache2/mods-enabled/mpm_worker.load

PORT=${PORT:-80}
SQLITE_PATH=${SQLITE_PATH:-/data/game.db}

# Configure Apache to listen on Railway's PORT
sed -i "s/Listen 80/Listen $PORT/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:$PORT>/" /etc/apache2/sites-available/000-default.conf

# Initialize SQLite database on first run
mkdir -p "$(dirname "$SQLITE_PATH")"

if [ ! -f "$SQLITE_PATH" ]; then
    echo "First run: converting MySQL dump to SQLite..."
    python3 /var/www/html/convert_db.py /var/www/html/sql.sql /tmp/game_init.sql
    sqlite3 "$SQLITE_PATH" < /tmp/game_init.sql
    rm -f /tmp/game_init.sql
    echo "Database ready at $SQLITE_PATH"
fi

exec "$@"
