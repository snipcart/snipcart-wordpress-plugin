#!/usr/bin/env sh

cd "$(dirname "$0")/../snipcart"
xgettext \
    --default-domain=snipcart-plugin \
    --language=PHP \
    --keyword=__ \
    --keyword=_e \
    --sort-by-file \
    --package-name=snipcart-plugin \
    --output=languages/snipcart-plugin.pot \
    *.php
