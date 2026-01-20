<?php
// Ngăn truy cập trực tiếp
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
// remove css from parent theme
function custom_child_remove_parent_assets()
{
    remove_action('wp_enqueue_scripts', 'default_underscore_scripts', 10);
}
add_action('after_setup_theme', 'custom_child_remove_parent_assets');

// dùng block editor mới cho widget có khả năng kéo thả widget
// khi kéo thả vào lần đầu bị mất form thì refresh page hết lỗi
add_filter('use_widgets_block_editor', '__return_false');


// add css
function child_underscore_scripts()
{
    // Custom CSS,JS files inside child theme
    $styles = [
        [
            'handle' => 'child-bootstrap-style',
            'src' => get_stylesheet_directory_uri() . '/plugins/bootstrap/css/bootstrap.min.css',
            'deps' => ['child-main-style'], // depends style.css
            'version' => wp_get_theme()->get('Version')
        ],
        [
            'handle' => 'child-themify-style',
            'src' => get_stylesheet_directory_uri() . '/plugins/themify/css/themify-icons.css',
            'deps' => [],
            'version' => wp_get_theme()->get('Version')
        ],
        [
            'handle' => 'child-fontawesome-style',
            'src' => get_stylesheet_directory_uri() . '/plugins/fontawesome/css/all.css',
            'deps' => [],
            'version' => wp_get_theme()->get('Version')
        ],
        [
            'handle' => 'child-magnific-popup-style',
            'src' => get_stylesheet_directory_uri() . '/plugins/magnific-popup/dist/magnific-popup.css',
            'deps' => [],
            'version' => wp_get_theme()->get('Version')
        ],
        [
            'handle' => 'child-slick-style',
            'src' => get_stylesheet_directory_uri() . '/plugins/slick-carousel/slick/slick.css',
            'deps' => [],
            'version' => wp_get_theme()->get('Version')
        ],
        [
            'handle' => 'child-slick-theme-style',
            'src' => get_stylesheet_directory_uri() . '/plugins/slick-carousel/slick/slick-theme.css',
            'deps' => [],
            'version' => wp_get_theme()->get('Version')
        ],
        [
            'handle' => 'child-main-style',
            'src' => get_stylesheet_directory_uri() . '/css/style.css',
            'deps' => [],
            'version' => wp_get_theme()->get('Version')
        ],
    ];

    // Duyệt qua mảng và enqueue các tệp CSS
    foreach ($styles as $style) {
        wp_enqueue_style(
            $style['handle'],  // Handle duy nhất
            $style['src'],     // Đường dẫn đến tệp CSS
            $style['deps'],    // Các phụ thuộc (mảng trống nếu không có)
            $style['version']  // Phiên bản của CSS
        );
    }


    // JS
    // Cần async defer nên ko dùng wp_enqueue_script được


    // comment-reply nếu cần
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'child_underscore_scripts', 20);

// load translate theo ngôn ngữ hiện tại
add_action('after_setup_theme', function () {
    $locale = determine_locale();
    $path   = get_stylesheet_directory() . "/languages/child-underscore-{$locale}.mo";

    if ( file_exists($path) ) {
        load_textdomain('child-underscore', $path);
    } else {
        load_textdomain(
            'child-underscore',
            get_stylesheet_directory() . "/languages/child-underscore-vi_VN.mo"
        );
    }
});