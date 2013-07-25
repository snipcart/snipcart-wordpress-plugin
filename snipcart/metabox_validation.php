<?php
/*
Adds validation for meta-box in admin.
*/

function snipcart_meta_box_validation_script() {
    global $post;
    if (!is_admin()) return;
    if ($post != NULL && $post->post_type != 'snipcart_product') return;
    $nonce = wp_create_nonce('snipcart_validation');
    ?>
    <script language="javascript" type="text/javascript">
    var snipcartStrings = {};
    snipcartStrings['containsErrors'] =
        '<?php _e('The form contains errors. The product was not updated.'); ?>';
    jQuery(function($) {
        function showErrors(errors) {
            $('.snipcart-validation-error').remove();
            $('.snipcart-has-error').removeClass('snipcart-has-error');
            $('#message').remove();
            $('<div>')
                .attr('id', 'message')
                .addClass('error')
                .addClass('below-h2')
                .html('<p>' + snipcartStrings['containsErrors'] + '</p>')
                .insertAfter('.wrap h2');
            for (var key in errors) {
                var $input = $('#' + key);
                var $errors = $('<span>')
                    .addClass('snipcart-validation-error')
                    .html(errors[key].join(', '))
                    .insertAfter($input);
                $input
                    .closest('.snipcart-field')
                    .addClass('snipcart-has-error');
            }
            $('body').scrollTop(0);
        }
        // remember which button was clicked if any (needed to publish)
        $('#post input[type=submit]').click(function() {
            $('<input type="hidden">')
                .appendTo($(this).parents('form').first())
                .attr('name', $(this).attr('name'))
                .attr('value', $(this).attr('value'))
                .addClass('clicked-button');
        });
        var formIsValid = false;
        $('#post').submit(function(ev) {
            if (!formIsValid) ev.preventDefault();
            var formData = JSON.stringify($('#post').serializeArray());
            var data = {
                action: 'snipcart_meta_box_validation',
                security: '<?php echo $nonce; ?>',
                form: formData
            };
            $.post(ajaxurl, data, function(errors) {
                $('.spinner').hide();
                $('#publish')
                    .prop('disabled', false)
                    .removeClass('button-primary-disabled');
                if ($.isEmptyObject(errors)) {
                    formIsValid = true;
                    $('#post').submit();
                } else {
                    showErrors(errors);
                    $('.clicked-button').remove();
                }
            });
        });
    });

    </script>
    <?php
}

function snipcart_meta_box_validation() {
    check_ajax_referer('snipcart_validation', 'security');
    $form_json = $_POST['form'];
    $form_json = str_replace('\\"', '"', $form_json);
    $form_json = str_replace("\\'", "'", $form_json);
    $form = json_decode($form_json, true);
    $post_id = snipcart_get_form_value($form, 'post_ID');
    header('Content-Type: application/json');
    $errors = array();

    $product_id = snipcart_get_form_value($form, 'snipcart-product-id');
    if ($product_id == NULL || trim($product_id) == '') {
        snipcart_add_error($errors, 'snipcart-product-id',
            __('This field is required', 'snipcart-plugin'));
    } else {
        $product_id = trim($product_id);
        $other_product_id =
            snipcart_other_product_that_uses_id($post_id, $product_id);
        if ($other_product_id != null) {
            $link = get_edit_post_link($other_product_id);
            snipcart_add_error($errors, 'snipcart-product-id', sprintf(
                __('Must be unique. <a href="%s">This product</a> already uses this ID.',
                'snipcart-plugin'),
                $link));
        }
    }

    $price = snipcart_get_form_value($form, 'snipcart-price');
    if ($price == NULL || trim($price) == '') {
        snipcart_add_error($errors, 'snipcart-price',
            __('This field is required', 'snipcart-plugin'));
    } else if (!preg_match('/^\\s*\\d+(.\\d{2})?\\s*$/', $price)) {
        snipcart_add_error($errors, 'snipcart-price',
            __('Must be a number of the form 123 or 123.45',
                'snipcart-plugin'));
    }

    $weight_required = get_option('snipcart_use_shipping');
    if ($weight_required == NULL) $weight_required = 'true';
    $weight = snipcart_get_form_value($form, 'snipcart-weight');
    if ($weight_required == 'true'
        && ($weight == NULL || trim($weight) == '')) {
        snipcart_add_error($errors, 'snipcart-weight',
            __('This field is required', 'snipcart-plugin'));
    } else if ($weight != NULL && trim($weight) != '' &&
        !preg_match('/^\\s*\\d+(.\\d+)?\\s*$/', $weight)) {
        snipcart_add_error($errors, 'snipcart-weight',
            __('Must be a number', 'snipcart-plugin'));
    }

    $max_quantity = snipcart_get_form_value($form, 'snipcart-max-quantity');
    if ($max_quantity != NULL && trim($max_quantity) != '' &&
        !preg_match('/^\\s*\\d+\\s*$/', $max_quantity)) {
        snipcart_add_error($errors, 'snipcart-max-quantity',
            __('Must be an integer', 'snipcart-plugin'));
    }

    if (count($errors) == 0) echo '{}';
    else echo json_encode($errors);
    die(); // or else will append '0' to response body
}

function snipcart_add_error(&$errors, $key, $error) {
    if (!array_key_exists($key, $errors))
        $errors[$key] = array();
    $errors[$key][] = $error;
}

function snipcart_get_form_value($form, $key) {
    $values = snipcart_get_form_values($form, $key);
    if (count($values) == 0) return NULL;
    return $values[0];
}

function snipcart_get_form_values($form, $key) {
    $values = array();
    foreach ($form as $elem) {
        if ($elem['name'] == $key) $values[] = $elem['value'];
    }
    return $values;
}

function snipcart_other_product_that_uses_id($post_id, $product_id) {
    global $wpdb;
    $sql =
        "SELECT post_id FROM {$wpdb->prefix}postmeta
            WHERE post_id != %d
                AND meta_key = 'snipcart_product_id'
                AND meta_value = '%s'";
    $existing_post_id =
        $wpdb->get_var($wpdb->prepare($sql, $post_id, $product_id));
    return $existing_post_id;
}
