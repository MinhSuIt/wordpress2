<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>

<?php
function scroll_to_shortcode($atts)
{
    extract(shortcode_atts([
        'class'          => '', // để custom css
        'id'          => '', // để custom phone
    ], $atts), EXTR_SKIP);

    ob_start();
    get_template_part(
        'base/template-parts/scroll-to/index',
        null,
        compact('class','id') // ~ ['class' => $class, 'id' => $id]
    );
    return ob_get_clean();
}
add_shortcode('scroll_to_shortcode', 'scroll_to_shortcode');
// echo do_shortcode('[scroll_to_shortcode class="custom-class" id="top" class="custom-class"]');
?>
