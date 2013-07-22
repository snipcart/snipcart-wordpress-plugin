<?php

function snipcart_add_locales() {
    load_plugin_textdomain('snipcart-plugin', false,
        basename(dirname(__FILE__)) . '/languages');
}
