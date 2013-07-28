#!/usr/bin/env sh

cd "$(dirname "$0")/../snipcart/languages"
rm *.mo
for file in `find . -name "*.po"` ; do msgfmt -o `echo $file | sed s/\.po/\.mo/` $file ; done
