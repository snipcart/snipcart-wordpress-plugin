<?php
/*
Adds content in <head> of public pages.
*/

function snipcart_enqueue_jquery() {
    wp_enqueue_script('jquery', false);
}

function snipcart_head_content() {
    $api_key = get_option('snipcart_api_key');
    ?>
    <link id="snipcart-theme"
        type="text/css"
        href="https://app.snipcart.com/themes/base/snipcart.css"
        rel="stylesheet">
    <script type="text/javascript"
        id="snipcart"
        src="https://app.snipcart.com/scripts/snipcart.js"
        data-api-key="<?php echo $api_key; ?>"></script>
    <?php
}
