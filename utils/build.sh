#!/usr/bin/env sh

cd "$(dirname "$0")/.."

echo 'Generating MO files'
utils/generate-mo-files.sh
echo 'Removing old snipcart.zip if exists'
rm -f snipcart-wordpress-plugin.zip
echo 'Generating snipcart.zip'
zip snipcart-wordpress-plugin.zip snipcart/*.php snipcart/*.txt snipcart/*.css snipcart/languages/*.mo
