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
// echo do_shortcode("[tabs_shortcode 
//     class='custom-class' 
//     title-1='Tab 1' 
//     tab-1='tab-1' 
//     title-2='Tab 2' 
//     tab-2='tab-2' 
//     title-3='Tab 3' 
//     tab-3='tab-3'
//     title-4='Tab 4' 
//     tab-4='tab-4'
// ]");
?>
