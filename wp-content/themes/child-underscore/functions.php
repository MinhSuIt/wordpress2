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
    

    '/shortcodes/woocommerce.php',
    '/base/template-parts/panel-post-list/set-up.php',
    '/base/shortcodes/panel-post-list.php',
    '/base/shortcodes/panel-tag-list.php',
    '/base/template-parts/menu/set-up.php',
    '/base/shortcodes/menu.php',
    '/base/shortcodes/call-button.php',
    '/base/shortcodes/scroll-to.php',
    '/base/shortcodes/post-list.php',
    '/base/shortcodes/gallery-lightbox.php',
    '/base/shortcodes/accordion.php',
    '/base/shortcodes/slider.php',
    '/base/shortcodes/tabs.php',
    '/base/shortcodes/breadcrumb.php',
    '/base/shortcodes/pagination.php',
    '/base/shortcodes/collapse.php',
    '/base/shortcodes/button.php',
    '/base/shortcodes/modal.php',
    '/base/shortcodes/progress.php',
    '/base/shortcodes/toast.php',

    '/base/tailwindcss/set-up.php',
];

foreach ($requires as $file) {
    require_once get_stylesheet_directory() . $file;
}