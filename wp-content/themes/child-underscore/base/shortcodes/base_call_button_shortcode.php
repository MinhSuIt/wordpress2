<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<?php
function base_call_button_shortcode($atts)
{
    wp_enqueue_style(
        'call-button',
        get_stylesheet_directory_uri() . '/base/template-parts/call-button/style.css',
        array(), // dependency
        wp_get_theme()->get('Version'),
        'all' // media: all, screen, print
    );

    extract(shortcode_atts([
        'class'          => '', // để custom css
        'phone'          => '', // để custom phone
    ], $atts), EXTR_SKIP);

    ob_start();
    get_template_part(
        'base/template-parts/call-button/index',
        null,
        compact('class', 'phone') // ~ ['class' => $class, 'phone' => $phone]
    );
    return ob_get_clean();
}
add_shortcode('base_call_button_shortcode', 'base_call_button_shortcode');
// <?php echo do_shortcode("[base_call_button_shortcode class='custom-class' phone='915452237']"); 
?>
