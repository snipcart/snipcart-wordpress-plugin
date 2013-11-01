<?php
/*
Plugin Name: Snipcart
Plugin URI: https://snipcart.com
Description: Easily sell with Snipcart. Adds "Product" post type and settings.
Author: Snipcart Team
Version: 0.2
Author URI: https://snipcart.com
*/
/*
The MIT License

Copyright (c) 2013 Snipcart, Inc. (https://snipcart.com)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

include(dirname(__FILE__).'/locales.php');
include(dirname(__FILE__).'/register_type.php');
include(dirname(__FILE__).'/metabox.php');
include(dirname(__FILE__).'/metabox_validation.php');
include(dirname(__FILE__).'/addtocart.php');
include(dirname(__FILE__).'/settings.php');
include(dirname(__FILE__).'/head.php');
include(dirname(__FILE__).'/nav.php');
include(dirname(__FILE__).'/styles.php');

add_action('plugins_loaded', 'snipcart_add_locales');
add_action('init', 'snipcart_register_product_type');
add_filter('post_updated_messages', 'snipcart_post_updated_messages');
add_action('add_meta_boxes', 'snipcart_add_product_meta_box');
add_action('admin_print_footer_scripts',
    'snipcart_meta_box_validation_script');
add_action('wp_ajax_snipcart_meta_box_validation',
    'snipcart_meta_box_validation');
add_action('save_post', 'snipcart_save_product', 10, 2);
add_filter('the_content', 'snipcart_add_addtocart_button');
add_action('admin_menu', 'snipcart_add_admin_menu');
add_action('admin_init', 'snipcart_add_admin_options');
add_action('wp_enqueue_scripts', 'snipcart_enqueue_jquery');
add_action('wp_head', 'snipcart_head_content');
add_action('admin_head', 'snipcart_add_styles');