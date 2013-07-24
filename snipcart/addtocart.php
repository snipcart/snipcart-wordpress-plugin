<?php
/*
Adds 'Add to Cart' to products.
*/

function snipcart_add_addtocart_button($content) {
    if (is_feed()) return $content;
    global $post;
    if ($post->post_type != 'snipcart_product') return $content;

    $content = snipcart_addtocartbutton() . $content;

    return $content;
}

function snipcart_addtocartbutton() {
    global $post;
    $attributes = array();

    $attributes['data-item-id'] =
        get_post_meta($post->ID, 'snipcart_product_id', true);

    $attributes['data-item-name'] = get_the_title();

    $attributes['data-item-price'] =
        get_post_meta($post->ID, 'snipcart_price', true);

    $attributes['data-item-url'] = get_permalink();

    $attributes['data-item-description'] =
        get_post_meta($post->ID, 'snipcart_description', true);

    $weight = get_post_meta($post->ID, 'snipcart_weight', true);
    if ($weight != NULL && $weight != '')
        $attributes['data-item-weight'] = $weight;

    $attributes['data-item-stackable'] =
        get_post_meta($post->ID, 'snipcart_stackable', true);

    $max_quantity = get_post_meta($post->ID, 'snipcart_max_quantity', true);
    if ($max_quantity != NULL && $max_quantity != '')
        $attributes['data-item-max-quantity'] = $max_quantity;

    if (has_post_thumbnail($post->ID)) {
        $image_id = get_post_thumbnail_id($post->ID);
        $image = wp_get_attachment_image_src($image_id, 'snipcart-image');
        $attributes['data-item-image'] = $image[0];
    }

    $attrs = '';
    foreach ($attributes as $key => $value) {
        $attr = $key . '="' . htmlspecialchars($value) . '" ';
        $attrs .= $attr;
    }

    $button_text = __('Add to Cart', 'snipcart-plugin');
    $button = '<p><a href="#" class="snipcart-add-item" '
        . $attrs . '>' . $button_text . '</a></p>';

    return $button;
}
