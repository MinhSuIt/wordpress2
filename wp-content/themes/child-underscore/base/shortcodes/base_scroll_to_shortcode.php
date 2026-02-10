<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<?php
function base_scroll_to_shortcode($atts)
{
    wp_enqueue_style(
        'scroll-to',
        get_stylesheet_directory_uri() . '/base/template-parts/scroll-to/style.css',
        array(), // dependency
        wp_get_theme()->get('Version'),
        'all' // media: all, screen, print
    );
    wp_enqueue_script(
        'scroll-to',
        get_stylesheet_directory_uri() . '/base/template-parts/scroll-to/js.js',
        array(),        // dependency, ví dụ: array('jquery')
        wp_get_theme()->get('Version'),
        array('strategy' => 'defer') // strategy: 'defer' hoặc 'async'
    );
    extract(shortcode_atts([
        'class'          => '', // để custom css
        'id'          => '', // để custom phone
    ], $atts), EXTR_SKIP);

    ob_start();
    get_template_part(
        'base/template-parts/scroll-to/index',
        null,
        compact('class', 'id') // ~ ['class' => $class, 'id' => $id]
    );
    return ob_get_clean();
}
add_shortcode('base_scroll_to_shortcode', 'base_scroll_to_shortcode');
// echo do_shortcode('[base_scroll_to_shortcode class="custom-class" id="top" class="custom-class"]');
?>
