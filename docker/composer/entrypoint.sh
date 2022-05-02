#!/bin/sh

find /home/composer/_dev -name composer.json -exec ls {} + | sed "s/composer.json//" | grep -v vendor | xargs composer install --working-dir



#NOTE for npm : find ./_dev -name package.json -exec ls {} + | sed "s/package.json//" | grep -v node_modules | xargs npm i --prefix