#!/usr/bin/env bash
echo "current directory: $(pwd)"
cd /var/www/matmatakids/matmatakids
echo "current directory after cd: $(pwd)"
if [ -d "/var/www/matmatakids/back/uploads" ]
then
    mv  /var/www/matmatakids/back/receipt /var/www/matmatakids/back/uploads public/
else
    echo "directories not moved because there not existed"
fi

npm install --prefix ./public chart.js --save
composer install
php bin/console doctrine:migrations:migrate
