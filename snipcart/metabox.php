<?php
/*
Adds custom section in the product page in the admin for produt details.
*/

function snipcart_add_product_meta_box() {
    add_meta_box(
        'snipcart-product-meta-box',
        __('Product Details', 'snipcart-plugin'),
        'snipcart_display_product_metabox',
        'snipcart_product',
        'normal',
        'high'
    );
}

function snipcart_display_product_metabox($post) {
    $product_id = get_post_meta($post->ID, 'snipcart_product_id', true);
    $price = get_post_meta($post->ID, 'snipcart_price', true);
    $weight = get_post_meta($post->ID, 'snipcart_weight', true);
    $description = get_post_meta($post->ID, 'snipcart_description', true);
    ?>
    <div class="snipcart-field">
        <p>
            <label for="snipcart-product-id">
                <?php _e('Product ID', 'snipcart-plugin'); ?>
                <span class="snipcart-required">*</span>
            </label>
        </p>
        <p>
            <input type="text"
                value="<?php echo $product_id; ?>"
                name="snipcart-product-id"
                id="snipcart-product-id"
                />
        </p>
    </div>
    <div class="snipcart-field">
        <p>
            <label for="snipcart-description">
                <?php _e('Description', 'snipcart-plugin'); ?>
            </label>
        </p>
        <p>
            <input type="text"
                value="<?php echo $description; ?>"
                name="snipcart-description"
                id="snipcart-description"
                />
        </p>
    </div>
    <div class="snipcart-field">
        <p>
            <label for="snipcart-price">
                <?php _e('Price', 'snipcart-plugin'); ?>
            </label>
        </p>
        <p>
            <input type="text"
                value="<?php echo $price; ?>"
                name="snipcart-price"
                id="snipcart-price"
                />
        </p>
    </div>
    <div class="snipcart-field">
        <p>
            <label for="snipcart-weight">
                <?php _e('Weight', 'snipcart-plugin'); ?>
            </label>
            <small><?php _e('in grams', 'snipcart-plugin'); ?></small>
        </p>
        <p>
            <input type="text"
                value="<?php echo $weight; ?>"
                name="snipcart-weight"
                id="snipcart-weight"
                />
        </p>
    </div>
    <?php
}

function snipcart_save_product($product_id, $product) {
    if ($product->post_type != 'snipcart_product') return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if ($_SERVER['REQUEST_METHOD'] != 'POST') return;

    update_post_meta($product_id, 'snipcart_price', $_POST['snipcart-price']);
    update_post_meta($product_id, 'snipcart_product_id',
        $_POST['snipcart-product-id']);
    update_post_meta($product_id, 'snipcart_weight',
        $_POST['snipcart-weight']);
    update_post_meta($product_id, 'snipcart_description',
        $_POST['snipcart-description']);
}
