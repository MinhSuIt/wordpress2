<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<?php
function base_collapse_shortcode($atts)
{
    wp_enqueue_style(
        'collapse',
        get_stylesheet_directory_uri() . '/base/template-parts/collapse/style.css',
        array(), // dependency
        wp_get_theme()->get('Version'),
        'all' // media: all, screen, print
    );
    wp_enqueue_script(
        'collapse',
        get_stylesheet_directory_uri() . '/base/template-parts/collapse/js.js',
        array(),        // dependency, ví dụ: array('jquery')
        wp_get_theme()->get('Version'),
        array('strategy' => 'defer') // strategy: 'defer' hoặc 'async'
    );
    extract(shortcode_atts([
        'class'          => '', // để custom css
        'folder'          => '', // để custom css
    ], $atts), EXTR_SKIP);

    unset($atts['class']); // tránh truyền thừa vào get_template_part
    unset($atts['folder']); // tránh truyền thừa vào get_template_part
    ob_start();
    get_template_part(
        'base/template-parts/collapse/index',
        null,
        compact('class', 'atts', 'folder') // ~ ['class' => $class, 'atts' => $atts]
    );
    return ob_get_clean();
}
add_shortcode('base_collapse_shortcode', 'base_collapse_shortcode');
// echo do_shortcode("[base_collapse_shortcode 
//     class='custom-class'
//     folder='base/template-parts/collapse/'
//     title-1='Trang chủ' 
//     title-2='Danh mục'
//     template-1='template-1'
//     template-2='template-2'
// ]");