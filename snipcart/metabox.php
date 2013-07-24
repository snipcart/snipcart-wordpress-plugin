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
    $weight_required = get_option('snipcart_use_shipping');
    if ($weight_required == NULL) $weight_required = 'true';
    $weight = get_post_meta($post->ID, 'snipcart_weight', true);
    $description = get_post_meta($post->ID, 'snipcart_description', true);
    $stackable = get_post_meta($post->ID, 'snipcart_stackable', true);
    $max_quantity = get_post_meta($post->ID, 'snipcart_max_quantity', true);
    ?>
    <div class="snipcart-field">
        <p>
            <label for="snipcart-product-id">
                <?php _e('Product ID', 'snipcart-plugin'); ?>
            </label>
            <span class="snipcart-required">*</span>
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
            <span class="snipcart-required">*</span>
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
            <?php if ($weight_required == 'true') : ?>
            <span class="snipcart-required">*</span>
            <?php endif; ?>
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
    <div class="snipcart-field">
        <p>
            <label for="snipcart-max-quantity">
                <?php _e('Maximum quantity', 'snipcart-plugin'); ?>
            </label>
            <small><?php _e('that a customer can buy', 'snipcart-plugin'); ?></small>
        </p>
        <p>
            <input type="text"
                value="<?php echo $max_quantity; ?>"
                name="snipcart-max-quantity"
                id="snipcart-max-quantity"
                />
        </p>
    </div>
    <div class="snipcart-field">
        <p>
            <label for="snipcart-stackable">
                <input type="checkbox"
                    value="true"
                    name="snipcart-stackable"
                    id="snipcart-stackable"
                    <?php if ($stackable == NULL || $stackable == 'true') {
                        echo 'checked';
                    }?>
                    />
                <?php _e('Stackable', 'snipcart-plugin'); ?>
            </label>
            <small>
                <?php _e('if not checked, customers can\'t edit quantity and each unit uses a new line',
                    'snipcart-plugin'); ?>
            </small>
        </p>
    </div>
    <?php
}

function snipcart_save_product($product_id, $product) {
    if ($product->post_type != 'snipcart_product') return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if ($_SERVER['REQUEST_METHOD'] != 'POST') return;

    update_post_meta($product_id, 'snipcart_price',
        trim($_POST['snipcart-price']));
    update_post_meta($product_id, 'snipcart_product_id',
        trim($_POST['snipcart-product-id']));
    update_post_meta($product_id, 'snipcart_weight',
        trim($_POST['snipcart-weight']));
    update_post_meta($product_id, 'snipcart_description',
        trim($_POST['snipcart-description']));
    update_post_meta($product_id, 'snipcart_max_quantity',
        trim($_POST['snipcart-max-quantity']));
    $stackable = trim($_POST['snipcart-stackable']) == 'true'
        ? 'true'
        : 'false';
    update_post_meta($product_id, 'snipcart_stackable', $stackable);
}
