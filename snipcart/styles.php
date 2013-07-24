<?php
/*
Adds plugin styles.
*/

function snipcart_add_styles() {
    $url = get_option('siteurl')
        . '/wp-content/plugins/'
        . basename(dirname(__FILE__))
        . '/styles.css';
    echo "<link rel='stylesheet' type='text/css' href='$url' />\n";
}
