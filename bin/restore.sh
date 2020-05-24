#!/usr/bin/env bash
echo "current directory: $(pwd)"
cd /var/www/matmatakids/matmatakids
echo "current directory after cd: $(pwd)"
if [ -d "/var/www/matmatakids/back/uploads" ]
then
    mv  /var/www/matmatakids/back/receipt/* public/receipt
    mv  /var/www/matmatakids/back/public/subventions public/subventions
    mv  /var/www/matmatakids/back/uploads public/uploads
    chmod 777 -R public/subventions public/receipt public/uploads
else
    echo "directories does not moved because there not existed"
fi

npm install --prefix ./public chart.js --save
composer install
php bin/console doctrine:migrations:migrate
