#!/bin/sh

find /home/composer/_dev -name composer.json -exec ls {} + | sed "s/composer.json//" | grep -v vendor | xargs composer install --working-dir