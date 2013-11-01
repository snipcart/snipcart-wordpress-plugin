<?php
/*
Adds a link in the default navigation (page list) if enabled in settings.
*/

function snipcart_add_nav_item($items) {
    $add_link = get_option('snipcart_add_products_nav_link');
    if ($add_link == NULL) $add_link = 'true';
    if ($add_link != 'true') return $items;

    global $wp_query;
    $class ='';

    if (isset($wp_query->query_vars['post_type'])
        && $wp_query->query_vars['post_type'] == 'snipcart_product')
        $class = 'current_page_item';

    $url = get_post_type_archive_link('snipcart_product');

    $myitem = '<li class="' . $class . '"><a href="' . $url . '">'
        . __('Products', 'snipcart-plugin') . '</a></li>';

    $items = $items . $myitem;
    return $items;
}
