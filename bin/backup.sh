#!/usr/bin/env bash
echo "current directory: $(pwd)"
cd /var/www/matmatakids/matmatakids
echo "current directory after cd: $(pwd)"



DIRU="/var/www/matmatakids/back/uploads"
DIRR="/var/www/matmatakids/back/receipt"
DIRS="/var/www/matmatakids/back/subventions"

#uploadss
if [ "$(ls -A $DIRU)" ]; then
     mv public/uploads/* /var/www/matmatakids/back/uploads
else
    echo "$DIRU is Empty"
fi

#receipt
if [ "$(ls -A $DIRR)" ]; then
     mv public/receipt/* /var/www/matmatakids/back/receipt
else
    echo "$DIRR is Empty"
fi

#subventions
if [ "$(ls -A $DIRS)" ]; then
     mv public/subventions/* /var/www/matmatakids/back/subventions
else
    echo "$DIRS is Empty"
fi

#npm install chart.js --save
#composer install
