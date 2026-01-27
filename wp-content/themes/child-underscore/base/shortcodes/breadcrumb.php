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
// echo do_shortcode("[breadcrumb_shortcode 
//     class='custom-class' 
//     title-1='Trang chủ' 
//     title-2='Danh mục'
//     title-3='Bài viết hiện tại' 
//     path-1='#'
//     path-2='#'
//     path-3='#'
// ]");
?>
