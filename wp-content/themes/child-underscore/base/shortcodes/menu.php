<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<?php
function menu_shortcode($atts)
{
    wp_enqueue_style(
        'menu',
        get_stylesheet_directory_uri() . '/base/template-parts/menu/style.css',
        array(), // dependency
        '1.0',
        'all' // media: all, screen, print
    );
    wp_enqueue_script(
        'menu',
        get_stylesheet_directory_uri() . '/base/template-parts/menu/js.js',
        array(),        // dependency, ví dụ: array('jquery')
        '1.0',
        array('strategy' => 'defer') // strategy: 'defer' hoặc 'async'
    );

    extract(shortcode_atts([
        'class'          => '' // để custom css
    ], $atts), EXTR_SKIP);

    ob_start();
    get_template_part(
        'base/template-parts/menu/index',
        null,
        compact('class') // ~ ['class' => $class]
    );
    return ob_get_clean();
}
add_shortcode('menu_shortcode', 'menu_shortcode');
// <?php echo do_shortcode("[menu_shortcode class='custom-class']"); 
?>
