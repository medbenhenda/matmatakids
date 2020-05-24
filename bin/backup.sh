#!/usr/bin/env bash
echo "current directory: $(pwd)"
cd /var/www/matmatakids/matmatakids
echo "current directory after cd: $(pwd)"
if [ -d "public/uploads" ]
then
    mv public/receipt/* /var/www/matmatakids/back/receipt
    mv public/subventions/* /var/www/matmatakids/back/subventions
    mv public/uploads/* /var/www/matmatakids/back/uploads
else
    echo "directories not moved because there not existed"
fi

#npm install chart.js --save
#composer install
