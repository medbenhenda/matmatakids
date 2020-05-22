#!/usr/bin/env bash
echo "current directory: $(pwd)"
cd /var/www/matmatakids/matmatakids
echo "current directory after cd: $(pwd)"
if [ -d "public/uploads" ]
then
    mv public/receipt public/uploads public/subventions /var/www/matmatakids/back
else
    echo "directories not moved because there not existed"
fi

#npm install chart.js --save
#composer install
