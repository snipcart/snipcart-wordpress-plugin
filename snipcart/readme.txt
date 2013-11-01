=== Snipcart ===
Tags: shopping cart, checkout, commerce, e-commerce, ecommerce, payment, payment gateway, shipping, delivery, tax, promo code, promocode, product
Requires at least: 3.0
Tested up to: 3.7
Stable tag: trunk
License: MIT
License URI: http://opensource.org/licenses/MIT

Effortless shopping cart. Adds Product post type and settings to use Snipcart.

== Description ==

Snipcart allows payment processing, shipping estimates and order management without ever letting your customers leave your website.

This plugin adds a new post `Product` type (like `Post` and `Page`) and a setting page.

The `Product` type contains additional fields used by Snipcart, like the price and product ID. Also, the title is used as the name of the product and the featured image as the product image.

The setting page is where you set you API key. You can also decide if you use shipping or not.

On the public side, the plugin adds an _Add to Cart_ button. It also adds a link to products in the default navigation (can be disabled in settings).

Note that you have to create an accout on [Snipcart](https://snipcart.com) to use this plugin. Also, when your customers are buying on your website, order information is sent to Snipcart. You can manage your orders on <https://snipcart.com>.

For theme development, the type that is added is `snipcart_product`.

There are localization files for:

* English
* French

If you would like to contribute, for localization or other development, the GitHub repository can be found at <https://github.com/snipcart/snipcart-wordpress-plugin>.

== Installation ==

1. Unzip the file
1. Copy the `snipcart` directory to `/wp-content/plugins/`
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Add your API key in the 'Settings' menu.
1. Add products by using the new 'Products' near 'Posts' and 'Pages'
1. If you use Wordpress Multisite, you have to go in each site that uses the plugin, `Settings` > `Permalinks` and `Save Changes`. If you don't, the products permalinks will give 404s.

== Changelog ==

= 0.2 =
* Add cart icons in admin for products.
* Add a link to products in default navigation, with setting to enable/disable it.