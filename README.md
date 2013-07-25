Snipcart Wordpress Plugin
=========================

This plugin adds a new post `Product` type (like `Post` and `Page`) and a setting page.

The `Product` type contains additional fields used by Snipcart, like the price and product ID. Also, the title is used as the name of the product and the featured image as the product image.

The setting page is where you set you API key. You can also decide if you use shipping or not.

On the public side, the plugin adds an _Add to Cart_ button.

## Installation

Copy the folder `snipcart` contained in the zip file into the `wp-content/plugins` folder. In the admin, go to the _Plugins_ section. You should see _Snipcart_ there. Click _Activate_.

You should now have a new _Product_ type in the left column, near _Posts_ and _Pages_. Also, you should have a new page in _Settings_ named _Snipcart_.

## Development

This section is for developers who contribute to this plugin.

### Locales

When editing PHP files, you have to regenerate the POT file.

    ./tools/generate-pot-file.sh

When the POT file has been generated, you can merge with existing PO files.

    ./tools/merge-po-file.sh fr_FR

When all the PO files are ready, you can generate the MO files.

    ./tools/generate-mo-files.sh

### Building the zip to distribute

This will generate the MO files, then zip the plugin into `snipcart.zip`.

    ./tools/build.sh
