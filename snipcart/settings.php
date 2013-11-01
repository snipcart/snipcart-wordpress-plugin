<?php
/*
Adds the settings page in the admin.
*/

function snipcart_add_admin_menu() {
    add_options_page(__('Snipcart Settings', 'snipcart-plugin'),
        'Snipcart', 'manage_options', 'snipcart-settings',
        'snipcart_display_settings_page');
}

function snipcart_add_admin_options() {
    register_setting('snipcart_options', 'snipcart_api_key',
        'snipcart_sanitize_option_string');
    register_setting('snipcart_options', 'snipcart_use_shipping',
        'snipcart_sanitize_option_use_shipping');
    register_setting('snipcart_options', 'snipcart_add_products_nav_link',
        'snipcart_sanitize_option_add_products_nav_link');
}

function snipcart_sanitize_option_string($string) {
    if ($string == null) $string = '';
    return esc_attr(trim($string));
}

function snipcart_sanitize_option_use_shipping($string) {
    if ($string == null || trim($string) == '') return 'false';
    return 'true';
}

function snipcart_sanitize_option_add_products_nav_link($string) {
    if ($string == null || trim($string) == '') return 'false';
    return 'true';
}

function snipcart_display_settings_page() {
    $form = array();
    $form['snipcart-api-key'] = get_option('snipcart_api_key');
    $form['snipcart-use-shipping'] = get_option('snipcart_use_shipping');
    if ($form['snipcart-use-shipping'] == NULL)
        $form['snipcart-use-shipping'] = 'true';
    $form['snipcart-add-products-nav-link'] =
        get_option('snipcart_add_products_nav_link');
    if ($form['snipcart-add-products-nav-link'] == NULL)
        $form['snipcart-add-products-nav-link'] = 'true';

    ?>
    <div class="wrap">
        <?php screen_icon('options-general'); ?>
        <h2><?php _e('Snipcart Settings', 'snipcart-plugin'); ?></h2>
        <form method="post" action="options.php">
            <?php settings_fields('snipcart_options'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="snipcart-api-key">
                            <?php _e('API Key', 'snipcart-plugin'); ?>
                        </label>
                    </th>
                    <td>
                        <input type="text"
                            name="snipcart_api_key"
                            id="snipcart-api-key"
                            class="regular-text"
                            value="<?php echo $form['snipcart-api-key'] ?>"
                            />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <?php _e('Shipping', 'snipcart-plugin'); ?>
                    </th>
                    <td>
                        <label for="snipcart-use-shipping">
                            <input type="checkbox"
                                name="snipcart_use_shipping"
                                id="snipcart-use-shipping"
                                value="true"
                                <?php if ($form['snipcart-use-shipping'] == 'true') {
                                    echo 'checked';
                                } ?>
                                />
                            <?php
                                _e('Use shipping. You will have to provide weight of each product.',
                                'snipcart-plugin');
                            ?>
                        </label>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <?php _e('Navigation', 'snipcart-plugin'); ?>
                    </th>
                    <td>
                        <label for="snipcart-add-products-nav-link">
                            <input type="checkbox"
                                name="snipcart_add_products_nav_link"
                                id="snipcart-add-products-nav-link"
                                value="true"
                                <?php if ($form['snipcart-add-products-nav-link'] == 'true') {
                                    echo 'checked';
                                } ?>
                                />
                            <?php
                                _e('Add a link to products in Wordpress default navigation.',
                                'snipcart-plugin');
                            ?>
                        </label>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
