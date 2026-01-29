<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
// Các trường hợp như:
// Đổi url của danh mục bài viết: abc.com/category/doi-song => abc.com/doi-song 
// --------------------------------------start--------------------------------------------
// lúc này sẽ dùng file index.php mà ko chạy file category.php nên cẩn thận, viết code sẽ chú ý file index.php (cho tất cả trang archive) và single.php (cho tất cả trang chi tiết)
// Loại bỏ /category/ nhưng không ảnh hưởng Page 
add_action('init', function () {

    $categories = get_categories(array(
        'hide_empty' => false
    ));

    if (!empty($categories)) {
        foreach ($categories as $cat) {

            $slug = $cat->slug;

            // Phân trang chuyên mục
            add_rewrite_rule(
                $slug . '/page/([0-9]+)/?$',
                'index.php?category_name=' . $slug . '&paged=$matches[1]',
                'top'
            );

            // Trang chuyên mục chính
            add_rewrite_rule(
                $slug . '/?$',
                'index.php?category_name=' . $slug,
                'top'
            );
        }
    }

    // Xóa category base trong permalinks
    global $wp_rewrite;
    $wp_rewrite->category_base = '';
});

// Redirect từ /category/... về /...
add_action('template_redirect', function () {
    if (is_category()) {
        $cat = get_queried_object();

        if (strpos($_SERVER['REQUEST_URI'], '/category/') !== false) {

            $url = home_url('/' . $cat->slug . '/');

            if (get_query_var('paged')) {
                $url .= 'page/' . get_query_var('paged') . '/';
            }

            wp_redirect($url, 301);
            exit;
        }
    }
});

// Filter xoá /category/ khỏi URL trả về từ WordPress
add_filter('term_link', function ($url, $term, $taxonomy) {
    if ($taxonomy === 'category') {
        return home_url('/' . $term->slug . '/');
    }
    return $url;
}, 10, 3);
// --------------------------------------end--------------------------------------------
