<?php
function modal_shortcode($atts)
{
    wp_enqueue_style(
        'modal',
        get_stylesheet_directory_uri() . '/base/template-parts/modal/style.css',
        array(), // dependency
        '1.0',
        'all' // media: all, screen, print
    );
    wp_enqueue_script(
        'modal',
        get_stylesheet_directory_uri() . '/base/template-parts/modal/js.js',
        array(),        // dependency, ví dụ: array('jquery')
        '1.0',
        array('strategy' => 'defer') // strategy: 'defer' hoặc 'async'
    );

    $atts = shortcode_atts([
        'id'               => 'modal-1',
        'title'            => 'Xin chào!',
        'template-content' => 'template-content',
        'folder'           => 'base/template-parts/modal/',
    ], $atts, 'modal_shortcode');

    ob_start();
    get_template_part("base/template-parts/modal/index", null,         [
        'id'               => $atts['id'],
        'title'            => $atts['title'],
        'template-content' => $atts['template-content'],
        'folder'           => $atts['folder'],
    ]);
    return ob_get_clean();
}
add_shortcode('modal_shortcode', 'modal_shortcode');
// echo do_shortcode("[modal_shortcode id='modal-1' title='Xin chào' template-content='template-content' folder='base/template-parts/modal/']");
