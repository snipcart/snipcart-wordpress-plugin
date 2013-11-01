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
    add_image_size('snipcart-image', 200, 200, true);
    add_filter('wp_list_pages', 'snipcart_add_nav_item');
    add_filter('wp_nav_menu_items', 'snipcart_add_nav_item');
}

function snipcart_post_updated_messages($messages) {
    global $post, $post_ID;
    $messages['snipcart_product'] = array(
        0 => '',
        1 => sprintf(__('Product updated. <a href="%s">View product</a>',
            'snipcart-plugin'),
            esc_url(get_permalink($post_ID))),
        2 => __('Custom field updated.', 'snipcart-plugin'),
        3 => __('Custom field deleted.', 'snipcart-plugin'),
        4 => __('Product updated.', 'snipcart-plugin'),
        5 => isset($_GET['revision'])
            ? sprintf(__('Product restored to revision from %s',
                'snipcart-plugin'),
            wp_post_revision_title((int) $_GET['revision'], false )) : false,
        6 => sprintf(__('Product published. <a href="%s">View product</a>',
                'snipcart-plugin'),
            esc_url(get_permalink($post_ID))),
        7 => __('Product saved.', 'snipcart-plugin'),
        8 => sprintf(__('Product submitted. <a target="_blank" href="%s">Preview product</a>',
                'snipcart-plugin'),
            esc_url(add_query_arg('preview', 'true',
                get_permalink($post_ID)))),
        9 => sprintf(__('Product scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview product</a>',
                'snipcart-plugin'),
            date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)),
            esc_url(get_permalink($post_ID))),
        10 => sprintf(
            __('Product draft updated. <a target="_blank" href="%s">Preview product</a>', 'snipcart-plugin'),
            esc_url(add_query_arg('preview', 'true',
            get_permalink($post_ID)))),
    );
    return $messages;
}
