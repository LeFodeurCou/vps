#!/bin/sh

find /home/npm/_dev -name package.json -exec ls {} + | sed "s/package.json//" | grep -v node_modules | xargs npm i --prefix