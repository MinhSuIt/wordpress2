<?php
function button_shortcode($atts)
{
    ob_start();

    get_template_part(
        'base/template-parts/button/index',
        null,
        $atts
    );

    return ob_get_clean();
}
add_shortcode('button_shortcode', 'button_shortcode');
