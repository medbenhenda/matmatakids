#!/usr/bin/env bash
echo "current directory: $(pwd)"
cd /var/www/matmatakids/matmatakids
echo "current directory after cd: $(pwd)"
if [ -d "/var/www/matmatakids/back/uploads" ]
then
    mv -r /var/www/matmatakids/back/ public/
else
    echo "directories not moved because there not existed"
fi

#npm install chart.js --save
#composer install
