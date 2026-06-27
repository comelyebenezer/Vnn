#!/bin/bash

echo "=== VNN Server Requirements Check ==="
echo ""

# PHP version
PHP_VER=$(php -v 2>/dev/null | head -1 | cut -d' ' -f2 | cut -d'.' -f1-2)
echo -n "PHP >= 8.3 ...................... "
if [ "$(echo "$PHP_VER >= 8.3" | bc -l 2>/dev/null)" = "1" ]; then
    echo "OK ($PHP_VER)"
else
    echo "FAIL ($PHP_VER) — upgrade to PHP 8.3+"
fi

# Extensions
for ext in bcmath ctype curl fileinfo json mbstring openssl pdo_mysql redis tokenian xml gd imagick intl exif; do
    echo -n "  PHP extension: $ext ......... "
    php -m | grep -qi "$ext" && echo "OK" || echo "MISSING"
done

# MySQL
echo -n "MySQL 8.0+ ....................... "
mysql --version 2>/dev/null | grep -q "8." && echo "OK" || echo "WARN — verify MySQL version"

# Redis
echo -n "Redis 6+ ........................ "
redis-server --version 2>/dev/null | grep -qE "v=[6-9]" && echo "OK" || echo "WARN — verify Redis version"

# Node/NPM (for build)
echo -n "Node.js 20+ ..................... "
NODE_VER=$(node -v 2>/dev/null | cut -d'v' -f2 | cut -d'.' -f1)
[ "$NODE_VER" -ge 20 ] 2>/dev/null && echo "OK (v$NODE_VER)" || echo "WARN — build may fail"

# Composer
echo -n "Composer 2+ ..................... "
COMPOSER_VER=$(composer -V 2>/dev/null | grep -oP '\d+\.\d+\.\d+' | head -1)
echo "OK ($COMPOSER_VER)"

# Supervisor
echo -n "Supervisor ...................... "
which supervisord 2>/dev/null && echo "OK" || echo "MISSING — needed for queue workers"

# Nginx
echo -n "Nginx .......................... "
nginx -v 2>&1 | head -1 && echo "OK" || echo "MISSING or not found in PATH"

echo ""
echo "=== Recommended system packages ==="
echo "  php8.3-bcmath php8.3-ctype php8.3-curl php8.3-fileinfo"
echo "  php8.3-mbstring php8.3-pdo-mysql php8.3-redis php8.3-xml"
echo "  php8.3-gd php8.3-imagick php8.3-intl php8.3-exif php8.3-tokenizer"
echo "  nginx mysql-server redis-server supervisor"
echo ""
echo "=== Directory permissions ==="
echo "  storage/      → 775 (www-data)"
echo "  bootstrap/cache/ → 775 (www-data)"
