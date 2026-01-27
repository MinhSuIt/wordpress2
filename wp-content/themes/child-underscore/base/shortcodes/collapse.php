<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<?php
function collapse_shortcode($atts)
{
    extract(shortcode_atts([
        'class'          => '', // để custom css
        'folder'          => '', // để custom css
    ], $atts), EXTR_SKIP);

    unset($atts['class']); // tránh truyền thừa vào get_template_part
    unset($atts['folder']); // tránh truyền thừa vào get_template_part
    ob_start();
    get_template_part(
        'base/template-parts/collapse/index',
        null,
        compact('class', 'atts', 'folder') // ~ ['class' => $class, 'atts' => $atts]
    );
    return ob_get_clean();
}
add_shortcode('collapse_shortcode', 'collapse_shortcode');
// echo do_shortcode("[collapse_shortcode 
//     class='custom-class'
//     folder='base/template-parts/collapse/'
//     title-1='Trang chủ' 
//     title-2='Danh mục'
//     template-1='template-1'
//     template-2='template-2'
// ]");