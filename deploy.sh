#!/usr/bin/env bash
echo "current directory: $(pwd)"
cd /var/www/matmatakids/matmatakids
echo "current directory after cd: $(pwd)"
mv public/bundles public/media public/node_modules public/receipt public/uploads /var/www/matmatakids/back
#npm install chart.js --save
#composer install
