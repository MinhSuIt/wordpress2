<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<?php
function slider_shortcode($atts)
{
    wp_enqueue_style(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css',
        array(),
        '12.0',
        'all'
    );
    wp_enqueue_style(
        'slider',
        get_stylesheet_directory_uri() . '/base/template-parts/slider/style.css',
        array('swiper'), // dependency
        '1.0',
        'all' // media: all, screen, print
    );
    wp_enqueue_script(
        'swiper-js',
        'https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js',
        array(),
        '12.0',
        array('strategy' => 'defer')
    );
    wp_enqueue_script(
        'slider',
        get_stylesheet_directory_uri() . '/base/template-parts/slider/js.js',
        array('swiper-js'),        // dependency, ví dụ: array('jquery')
        '1.0',
        array('strategy' => 'defer') // strategy: 'defer' hoặc 'async'
    );
    extract(shortcode_atts([
        'class'          => '', // để custom css
    ], $atts), EXTR_SKIP);

    unset($atts['class']); // tránh truyền thừa vào get_template_part
    ob_start();
    get_template_part(
        'base/template-parts/slider/index',
        null,
        compact('class', 'atts') // ~ ['class' => $class, 'atts' => $atts]
    );
    return ob_get_clean();
}
add_shortcode('slider_shortcode', 'slider_shortcode');
// echo do_shortcode('[slider_shortcode 
//     class="custom-class" 
//     title-1="Siêu phẩm máy móc" 
//     img-1="https://picsum.photos/id/237/600/400" 
//     url-1=""
//     title-2="Du lịch khám phá" 
//     img-2="https://picsum.photos/id/238/600/400" 
//     url-2="#"
//     title-3="Thiên đường ẩm thực"
//     img-3="https://picsum.photos/id/239/600/400" 
//     url-3="#"
//     title-4="Phong cảnh tuyệt đẹp"
//     img-4="https://picsum.photos/id/240/600/400" 
//     url-4="#"
//     title-5="Cuộc sống hiện đại"
//     img-5="https://picsum.photos/id/241/600/400" 
//     url-5="#"
//     title-6="Công nghệ tiên tiến"
//     img-6="https://picsum.photos/id/242/600/400" 
//     url-6="#"
//     title-7="Khám phá vũ trụ"
//     img-7="https://picsum.photos/id/243/600/400" 
//     url-7="#"
//     title-8="Nghệ thuật sáng tạo"
//     img-8="https://picsum.photos/id/244/600/400" 
//     url-8="#"
// ]');
?>
