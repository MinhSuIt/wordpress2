<?php
// Ngăn truy cập trực tiếp
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
function theme_add_woocommerce_support()
{
    // custom template woocommerce
    add_theme_support('woocommerce', array(
        'thumbnail_image_width' => 150,
        'single_image_width'    => 300,

        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 4,
            'min_columns'     => 2,
            'max_columns'     => 5,
        ),
    ));
    // sidebar kéo thả
    register_sidebar([
        'name' => 'Shop sidebar',
        'id'  => 'shop-sidebar',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
    ]);
}
add_action('after_setup_theme', 'theme_add_woocommerce_support');


function theme_woocommerce_get_sidebar()
{
    if (! defined('ABSPATH')) {
        exit; // Exit if accessed directly
    }

    get_sidebar('shop');
}

remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

add_action('woocommerce_sidebar', function () {
    if (is_active_sidebar('shop-sidebar')) {
        dynamic_sidebar('shop-sidebar');
    }
}, 10);

// add_action('custom_woocommerce_sidebar', 'theme_woocommerce_get_sidebar', 10);