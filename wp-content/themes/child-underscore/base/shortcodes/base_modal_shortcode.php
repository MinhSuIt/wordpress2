<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<?php
function base_modal_shortcode($atts)
{
    wp_enqueue_style(
        'modal',
        get_stylesheet_directory_uri() . '/base/template-parts/modal/style.css',
        array(), // dependency
        wp_get_theme()->get('Version'),
        'all' // media: all, screen, print
    );
    wp_enqueue_script(
        'modal',
        get_stylesheet_directory_uri() . '/base/template-parts/modal/js.js',
        array(),        // dependency, ví dụ: array('jquery')
        wp_get_theme()->get('Version'),
        array('strategy' => 'defer') // strategy: 'defer' hoặc 'async'
    );

    $atts = shortcode_atts([
        'id'               => 'modal-1',
        'title'            => 'Xin chào!',
        'template-content' => 'template-content',
        'folder'           => 'base/template-parts/modal/',
    ], $atts, 'base_modal_shortcode');

    ob_start();
    get_template_part("base/template-parts/modal/index", null,         [
        'id'               => $atts['id'],
        'title'            => $atts['title'],
        'template-content' => $atts['template-content'],
        'folder'           => $atts['folder'],
    ]);
    return ob_get_clean();
}
add_shortcode('base_modal_shortcode', 'base_modal_shortcode');
// echo do_shortcode("[base_modal_shortcode id='modal-1' title='Xin chào' template-content='template-content' folder='base/template-parts/modal/']");
