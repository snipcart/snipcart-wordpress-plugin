<?php
/*
Adds custom section in the product page in the admin for produt details.
*/

function snipcart_add_product_meta_box() {
    add_meta_box(
        'snipcart_product_meta_box',
        'Product Details',
        'snipcart_display_product_metabox',
        'snipcart_product',
        'side',
        'high'
    );
}

function snipcart_display_product_metabox($post) {
    $product_id = get_post_meta($post->ID, 'snipcart_product_id', true);
    $price = get_post_meta($post->ID, 'snipcart_price', true);
    $weight = get_post_meta($post->ID, 'snipcart_weight', true);
    ?>
    <table>
        <tr>
            <th>
                <label for="snipcart-product-id">Product ID</label>
            </th>
            <td>
                <input type="text"
                    value="<?php echo $product_id; ?>"
                    name="snipcart-product-id"
                    id="snipcart-product-id"
                    />
            </td>
        </tr>
        <tr>
            <th>
                <label for="snipcart-price">Price</label>
            </th>
            <td>
                <input type="text"
                    value="<?php echo $price; ?>"
                    name="snipcart-price"
                    id="snipcart-price"
                    />
            </td>
        </tr>
        <tr>
            <th>
                <label for="snipcart-weight">Weight</label>
            </th>
            <td>
                <input type="text"
                    value="<?php echo $weight; ?>"
                    name="snipcart-weight"
                    id="snipcart-weight"
                    />
            </td>
        </tr>
    </table>
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
}
