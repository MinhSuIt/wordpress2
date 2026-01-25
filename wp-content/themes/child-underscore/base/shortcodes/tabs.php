<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<?php
function tabs_shortcode($atts)
{
    extract(shortcode_atts([
        'class'          => '', // để custom css
        'folder'     => 'base/template-parts/tabs/', // thư mục chứa template-part   
    ], $atts), EXTR_SKIP);

    unset($atts['class']); // tránh truyền thừa vào get_template_part
    unset($atts['folder']); // tránh truyền thừa vào get_template_part
    ob_start();
    get_template_part(
        'base/template-parts/tabs/index',
        null,
        compact('class', 'atts', 'folder') // ~ ['class' => $class, 'atts' => $atts]
    );
    return ob_get_clean();
}
add_shortcode('tabs_shortcode', 'tabs_shortcode');
?>
