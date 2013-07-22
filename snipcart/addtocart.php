<?php
/*
Adds 'Add to Cart' to products.
*/

function snipcart_add_addtocart_button($content) {
    if (is_feed()) return $content;

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
    $attributes['data-item-price'] =
        get_post_meta($post->ID, 'snipcart_weight', true);

    $attrs = '';
    foreach ($attributes as $key => $value) {
        // TODO encode special chars of $value
        $attr = $key . '="' . $value . '" ';
        $attrs .= $attr;
    }

    $button_text = __('Add to Cart', 'snipcart-plugin');
    $button = '<p><a href="#" class="snipcart-add-item" '
        . $attrs . '>' . $button_text . '</a></p>';

    return $button;
}
