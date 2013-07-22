Snipcart Wordpress Plugin
=========================

This is a plugin for Wordpress to add "products" post type and snipcart settings.

Do not use as of yet, it is still in very infatile stage.

## Development

This section is for developers who contriute to this plugin.

### Locales

#### Generating POT file

Go in `snipcart-wordpress-plugin/snipcart` directory and execute the following line. __TODO Write a bash file for that__

    xgettext --default-domain=snipcart-plugin --language=PHP --keyword=__ --keyword=_e --sort-by-file --package-name=snipcart-plugin *.php

#### Generating a new PO file

__TODO__

#### Merging an existing PO file with a new POT file

__TODO__

#### Generating MO file

Go in `snipcart-wordpress-plugin/snipcart/languages` and execute the following line. __TODO Write a bash file for that__

    for file in `find . -name "*.po"` ; do msgfmt -o `echo $file | sed s/\.po/\.mo/` $file ; done
