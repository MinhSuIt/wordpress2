<?php
function base_search_form_with_icon_shortcode($atts)
{
    wp_enqueue_style(
        'base_search_form_with_icon_shortcode',
        get_stylesheet_directory_uri() . '/base/template-parts/search-form-with-icon/style.css',
        array(), // dependency
        wp_get_theme()->get('Version'),
        'all' // media: all, screen, print
    );

    wp_enqueue_script(
        'menu',
        get_stylesheet_directory_uri() . '/base/template-parts/search-form-with-icon/js.js',
        array(),        // dependency, ví dụ: array('jquery')
        wp_get_theme()->get('Version'),
        array('strategy' => 'defer') // strategy: 'defer' hoặc 'async'
    );

    ob_start();

    get_template_part(
        'base/template-parts/search-form-with-icon/index',
        null,
        $atts
    );

    return ob_get_clean();
}
add_shortcode('base_search_form_with_icon_shortcode', 'base_search_form_with_icon_shortcode');
