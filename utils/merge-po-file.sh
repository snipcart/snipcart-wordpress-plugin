#!/usr/bin/env sh

cd "$(dirname "$0")/../snipcart/languages"
msgmerge -N snipcart-plugin-$1.po snipcart-plugin.pot > temp.po
mv snipcart-plugin-$1.po snipcart-plugin-$1.po.bak
mv temp.po snipcart-plugin-$1.po
