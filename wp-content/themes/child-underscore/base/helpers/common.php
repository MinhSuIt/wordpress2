<?php

function debug_log($message)
{
    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('DEBUG LOG: ' . $message);
    }
}

function file_list_in_directory($directory_path)
{
    $file_list = [];
    $files = scandir($directory_path);

    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            $file_list[] = $file;
        }
    }
    return $file_list;
}

// tính từ thư mục child theme active
function require_files($shortcode_directory)
{
    $files = file_list_in_directory(get_stylesheet_directory() . $shortcode_directory);
    foreach ($files as $file) {
        require_once get_stylesheet_directory() . $shortcode_directory . $file;
    }
}

// debug sql queries
add_action('shutdown', function () {
    global $wpdb;

    if (!defined('WP_DEBUG_SQL_QUERY') || !WP_DEBUG_SQL_QUERY) return;
    $queries = $wpdb->queries;
    foreach ($queries as $query) {
        error_log($query[0]); // SQL string
    }
});

// delay những js ko cần load khi ko ở viewport đầu trang pagespeed LCP
// ví dụ: slider giữa cuối trang, player phim ở đầu trang nhưng cần tương tác mới load js
// dùng trong shortcode:
// delay_js_loader([
//     [
//         'id' => 'test-delay-js-loader',
//         'src' => get_stylesheet_directory_uri() . '/base/helpers/test-delay-js-loader.js',
//         'strategy' => 'defer'
//     ],
// ]);
function delay_js_loader($scripts)
{
    wp_enqueue_script(
        'delay-js-loader',
        get_stylesheet_directory_uri() . '/base/helpers/delay-js-loader.js',
        array(),        // dependency, ví dụ: array('jquery')
        wp_get_theme()->get('Version'),
        array('strategy' => 'defer') // strategy: 'defer' hoặc 'async'
    );
    wp_localize_script(
        'delay-js-loader',
        'scripts', // tên object JS
        $scripts
    );
}

// lấy phiên bản ảnh khác của url
function get_other_image_from_url($image_url, $size = "thumbnail")
{
    // $image_url = "http://phim.test/wp-content/uploads/2026/02/1756028219981_479818901.jpg";
    $attachment_id = attachment_url_to_postid($image_url);
    $thumb  = wp_get_attachment_image_url($attachment_id, $size);
    return $thumb;
}

// lấy cấu hình các phiên bản hình ảnh media
function get_registered_image_sizes()
{
    return wp_get_registered_image_subsizes();
}
