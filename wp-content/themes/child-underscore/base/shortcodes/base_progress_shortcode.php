<?php
if (!defined('ABSPATH')) {
    exit;
}

function base_progress_shortcode($atts)
{
    wp_enqueue_style(
        'progress',
        get_stylesheet_directory_uri() . '/base/template-parts/progress/style.css',
        array(), // dependency
        wp_get_theme()->get('Version'),
        'all' // media: all, screen, print
    );

    $atts = extract(shortcode_atts([
        'progress' => '100%',
        'class' => '',
    ], $atts, 'base_progress_shortcode'), EXTR_SKIP);
    ob_start();
    get_template_part('base/template-parts/progress/index', null, compact('progress', 'class'));
    return ob_get_clean();
}

add_shortcode('base_progress_shortcode', 'base_progress_shortcode');
// echo do_shortcode("[base_progress_shortcode class='custom-class' progress='50%']");
