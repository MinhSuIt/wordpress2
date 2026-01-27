<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<?php
function collapse_shortcode($atts)
{
    wp_enqueue_style(
        'collapse',
        get_stylesheet_directory_uri() . '/base/template-parts/collapse/style.css',
        array(), // dependency
        '1.0',
        'all' // media: all, screen, print
    );
    wp_enqueue_script(
        'collapse',
        get_stylesheet_directory_uri() . '/base/template-parts/collapse/js.js',
        array(),        // dependency, ví dụ: array('jquery')
        '1.0',
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
add_shortcode('collapse_shortcode', 'collapse_shortcode');
// echo do_shortcode("[collapse_shortcode 
//     class='custom-class'
//     folder='base/template-parts/collapse/'
//     title-1='Trang chủ' 
//     title-2='Danh mục'
//     template-1='template-1'
//     template-2='template-2'
// ]");