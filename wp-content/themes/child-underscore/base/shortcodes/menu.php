<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>

<?php
function menu_shortcode($atts)
{
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
