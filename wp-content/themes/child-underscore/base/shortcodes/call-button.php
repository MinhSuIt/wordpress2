<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>

<?php
function call_button_shortcode($atts)
{
    extract(shortcode_atts([
        'class'          => '', // để custom css
        'phone'          => '', // để custom phone
    ], $atts), EXTR_SKIP);

    ob_start();
    get_template_part(
        'base/template-parts/call-button/index',
        null,
        compact('class','phone') // ~ ['class' => $class, 'phone' => $phone]
    );
    return ob_get_clean();
}
add_shortcode('call_button_shortcode', 'call_button_shortcode');
// <?php echo do_shortcode("[call_button_shortcode class='custom-class' phone='915452237']"); 
?>
