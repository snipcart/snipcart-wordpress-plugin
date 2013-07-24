<?php
/*
Adds the settings page in the admin.
*/

function snipcart_add_admin_menu() {
    add_options_page(__('Snipcart Settings', 'snipcart-plugin'),
        'Snipcart', 'manage_options', 'snipcart-settings',
        'snipcart_display_settings_page');
}

function snipcart_display_settings_page() {
    $saved = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $api_key = esc_attr(trim($_POST['snipcart-api-key']));
        $use_shipping =
            array_key_exists('snipcart-use-shipping', $_POST)
                && esc_attr(trim($_POST['snipcart-use-shipping'])) == 'true'
                ? 'true'
                : 'false';
        update_option('snipcart_api_key', $api_key);
        update_option('snipcart_use_shipping', $use_shipping);
        $saved = true;
    }

    $form = array();
    $form['snipcart-api-key'] = get_option('snipcart_api_key');
    $form['snipcart-use-shipping'] = get_option('snipcart_use_shipping');
    if ($form['snipcart-use-shipping'] == NULL)
        $form['snipcart-use-shipping'] = 'true';

    ?>
    <div class="wrap">
        <?php screen_icon('options-general'); ?>
        <h2><?php _e('Snipcart Settings', 'snipcart-plugin'); ?></h2>
        <?php if ($saved): ?>
        <div id="setting-error-settings_updated" class="updated settings-error">
            <p>
                <strong>
                    <?php _e('Settings saved.', 'snipcart-plugin'); ?>
                </strong>
            </p>
        </div>
        <?php endif; ?>
        <form method="POST" action="">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="snipcart-api-key">
                            <?php _e('API Key', 'snipcart-plugin'); ?>
                        </label>
                    </th>
                    <td>
                        <input type="text"
                            name="snipcart-api-key"
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
                                name="snipcart-use-shipping"
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
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
