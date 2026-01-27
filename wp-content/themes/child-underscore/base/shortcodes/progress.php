<?php
if (!defined('ABSPATH')) {
    exit;
}

function progress_shortcode($atts)
{
    $atts = extract(shortcode_atts([
        'progress' => '100%',
        'class' => '',
    ], $atts, 'progress_shortcode'), EXTR_SKIP);
    ob_start();
    get_template_part('base/template-parts/progress/index', null, compact('progress', 'class'));
    return ob_get_clean();
}

add_shortcode('progress_shortcode', 'progress_shortcode');
// echo do_shortcode("[progress_shortcode class='custom-class' progress='50%']");
