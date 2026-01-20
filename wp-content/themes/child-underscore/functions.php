<?php
$requires = [
    '/custom/helper.php',
    '/custom/custom-menu-header.php',
    '/custom/custom-post-type-ui.php',
    '/custom/wordpress.php',
    '/custom/woocommerce.php',
    '/custom/variation-swatches-for-woocommerce.php',
    '/custom/admin-post.php',
    '/custom/ajax.php',

    '/shortcodes/woocommerce.php',
];

foreach ($requires as $file) {
    require_once get_stylesheet_directory() . $file;
}


