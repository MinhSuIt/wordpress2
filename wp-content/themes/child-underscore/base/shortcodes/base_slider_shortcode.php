<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<?php
function base_slider_shortcode($atts)
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
        wp_get_theme()->get('Version'),
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
        wp_get_theme()->get('Version'),
        array('strategy' => 'defer') // strategy: 'defer' hoặc 'async'
    );

    extract(shortcode_atts([
        'class'          => '', // để custom css
        'display_prev_next'          => "",
        'display_pagination'          => "",
    ], $atts), EXTR_SKIP);

    // truyền param cho js
    wp_localize_script(
        'slider',
        'sliderData', // tên object JS
        array(
            'display_prev_next' => $display_prev_next,
            'display_pagination' => $display_pagination,
        )
    );

    unset($atts['class']); // tránh truyền thừa vào get_template_part
    unset($atts['display_prev_next']); // tránh truyền thừa vào get_template_part
    unset($atts['display_pagination']); // tránh truyền thừa vào get_template_part
    ob_start();
    get_template_part(
        'base/template-parts/slider/index',
        null,
        compact('class', 'display_prev_next', 'display_pagination', 'atts') // 
    );
    return ob_get_clean();
}
add_shortcode('base_slider_shortcode', 'base_slider_shortcode');
// echo do_shortcode('[base_slider_shortcode 
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
