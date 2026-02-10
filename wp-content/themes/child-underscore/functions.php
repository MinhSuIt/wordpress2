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
    // '/custom/rewrite-url.php',


    '/base/tailwindcss/set-up.php',
    '/base/helpers/common.php',
    // '/base/ux-builder/set-up.php', // nếu dùng ux builder shortcode, thêm lại các ux builder shortcode cần dùng

    '/shortcodes/woocommerce.php',

    '/base/template-parts/menu/set-up.php',

    '/base/tailwindcss/set-up.php',
];

foreach ($requires as $file) {
    require_once get_stylesheet_directory() . $file;
}
require_files('/base/shortcodes/');
