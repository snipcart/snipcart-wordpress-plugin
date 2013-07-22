<?php
/*
Registers the new Product post type (snipcart_product).
*/

function snipcart_register_product_type() {
    $labels = array(
        'name' => __('Products', 'snipcart-plugin'),
        'singular_name' => __('Product', 'snipcart-plugin'),
        'add_new' => __('Add New', 'snipcart-plugin'),
        'add_new_item' => __('Add New Product', 'snipcart-plugin'),
        'edit_item' => __('Edit Product', 'snipcart-plugin'),
        'new_item' => __('New Product', 'snipcart-plugin'),
        'all_items' => __('All Products', 'snipcart-plugin'),
        'view_item' => __('View Product', 'snipcart-plugin'),
        'search_items' => __('Search Products', 'snipcart-plugin'),
        'not_found' =>  __('No products found', 'snipcart-plugin'),
        'not_found_in_trash' => __('No products found in Trash', 'snipcart-plugin'),
        'parent_item_colon' => '',
        'menu_name' => __('Products', 'snipcart-plugin')
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'products'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 20,
        'supports' => array(
            'title',
            'editor',
            'author',
            'thumbnail',
            'excerpt',
            'comments'
        )
    );

    register_post_type('snipcart_product', $args);
}
