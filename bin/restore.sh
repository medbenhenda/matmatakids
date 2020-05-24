#!/usr/bin/env bash
echo "current directory: $(pwd)"
cd /var/www/matmatakids/matmatakids
DIRU="/var/www/matmatakids/back/uploads"
DIRR="/var/www/matmatakids/back/receipt"
DIRS="/var/www/matmatakids/back/subventions"
echo "current directory after cd: $(pwd)"

#uploadss
if [ "$(ls -A $DIRU)" ]; then
     mv  /var/www/matmatakids/back/uploads/* public/uploads
     chmod 777 -R public/uploads
else
    echo "$DIRU is Empty"
fi

#subventions
if [ "$(ls -A $DIRS)" ]; then
     mv  /var/www/matmatakids/back/subventions/* public/subventions
     chmod 777 -R public/subventions
else
    echo "$DIRS is Empty"
fi

#receipt
if [ "$(ls -A $DIRR)" ]; then
     mv  /var/www/matmatakids/back/receipt/* public/receipt
     chmod 777 -R public/receipt
else
    echo "$DIRR is Empty"

fi

npm install --prefix ./public chart.js --save
composer install
php bin/console doctrine:migrations:migrate
