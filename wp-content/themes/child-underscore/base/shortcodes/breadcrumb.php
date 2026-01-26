<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>

<?php
function breadcrumb_shortcode($atts)
{
    extract(shortcode_atts([
        'class'          => '', // để custom css
    ], $atts), EXTR_SKIP);
    unset($atts['class']);
    ob_start();
    get_template_part(
        'base/template-parts/breadcrumb/index',
        null,
        compact('class','atts') // ~ ['class' => $class]
    );
    return ob_get_clean();
}
add_shortcode('breadcrumb_shortcode', 'breadcrumb_shortcode');
// <?php echo do_shortcode("[breadcrumb_shortcode class='custom-class']"); 
?>
