<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<?php
function accordion_shortcode($atts)
{
    wp_enqueue_style(
        'accordion',
        get_stylesheet_directory_uri() . '/base/template-parts/accordion/style.css',
        array(), // dependency
        '1.0',
        'all' // media: all, screen, print
    );
    wp_enqueue_script(
        'accordion',
        get_stylesheet_directory_uri() . '/base/template-parts/accordion/js.js',
        array(),        // dependency, ví dụ: array('jquery')
        '1.0',
        array('strategy' => 'defer') // strategy: 'defer' hoặc 'async'
    );
    // nếu tách các code này thành plugin thì load bằng: plugin_dir_url
    // ngoài ra check page cụ thể để load css/js: is_page_template/is_page/is_single/is_home...
    extract(shortcode_atts([
        'class'          => '', // để custom css
        'folder'         => 'base/template-parts/accordion/' // từ theme hiện tại
    ], $atts), EXTR_SKIP);

    unset($atts['class']); // tránh truyền thừa vào get_template_part
    unset($atts['folder']); // tránh truyền thừa vào get_template_part
    ob_start();
    get_template_part(
        'base/template-parts/accordion/index',
        null,
        compact('class', 'folder', 'atts') // ~ ['class' => $class, 'folder' => $folder, 'atts' => $atts]
    );
    return ob_get_clean();
}
add_shortcode('accordion_shortcode', 'accordion_shortcode');
// echo do_shortcode("[accordion_shortcode class='custom-class' title-1='Accordion item 1' title-2='Accordion item 2' title-3='Accordion item 3' template-1='template-1' template-2='template-2' template-3='template-3']");
?>
