#!/usr/bin/env sh

cd "$(dirname "$0")/.."

echo 'Generating MO files'
utils/generate-mo-files.sh
echo 'Removing old snipcart.zip if exists'
rm -f snipcart.zip
echo 'Generating snipcart.zip'
zip snipcart.zip snipcart/*.php snipcart/languages/*.mo
