<?php
if (!defined('ABSPATH')) {
    exit;
}
function base_item_2_shortcode($atts)
{
    $atts = extract(shortcode_atts([
        'class' => 'sss',
        'heading' => 'h3',
        'title' => '',
        'description' => '',
        'img' => '',
        'url' => '#',
        'srcset' => '',
    ], $atts, 'base_item_2_shortcode'), EXTR_SKIP);
    ob_start();
    get_template_part('base/template-parts/item-2/index', null, compact('class', 'heading', 'title', 'description', 'img', 'url', 'srcset'));
    return ob_get_clean();
}

add_shortcode('base_item_2_shortcode', 'base_item_2_shortcode');
// echo do_shortcode("[base_item_2_shortcode class='custom-class']");
