<?php
function base_custom_button_shortcode($atts)
{
    wp_enqueue_style(
        'button',
        get_stylesheet_directory_uri() . '/base/template-parts/button/style.css',
        array(), // dependency
        wp_get_theme()->get('Version'),
        'all' // media: all, screen, print
    );
    ob_start();

    get_template_part(
        'base/template-parts/button/index',
        null,
        $atts
    );

    return ob_get_clean();
}
add_shortcode('base_custom_button_shortcode', 'base_custom_button_shortcode');
// button với thẻ a chuyển hướng
// echo do_shortcode("[base_custom_button_shortcode class='custom-class' text='Ghé 24h' url='24h.com.vn' type='a']"); 
// button với support modal có id là modal-1
// echo do_shortcode("[base_custom_button_shortcode class='custom-class' text='Xem thêm' url='24h.com.vn' type='button' data-modal-target='modal-1']");