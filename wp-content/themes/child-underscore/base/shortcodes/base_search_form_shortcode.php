<?php
function base_search_form_shortcode($atts)
{
    ob_start();

    get_template_part(
        'base/template-parts/search-form/index',
        null,
        $atts
    );

    return ob_get_clean();
}
add_shortcode('base_search_form_shortcode', 'base_search_form_shortcode');
