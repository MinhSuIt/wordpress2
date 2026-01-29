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
// custom taxonomy
// --------------------------------------start--------------------------------------------
//Rewrite phân trang loại bỏ slug custom taxonomy
add_filter('term_link', function ($url, $term, $taxonomy) {

    if ($taxonomy !== 'danh_muc_file') return $url;

    $parent = $term->parent ? get_term($term->parent, 'danh_muc_file') : null;

    if ($parent) {
        return home_url('/' . $parent->slug . '/' . $term->slug . '/');
    }

    // Nếu category cha (root)
    return home_url('/' . $term->slug . '/');
}, 10, 3);

add_action('init', function () {

    $taxonomy = 'danh_muc_file';

    $terms = get_terms([
        'taxonomy' => $taxonomy,
        'hide_empty' => false
    ]);

    if (empty($terms) || is_wp_error($terms)) return;

    foreach ($terms as $term) {

        $parent = $term->parent ? get_term($term->parent, $taxonomy) : null;

        if ($parent) {
            // URL dạng /parent/child/
            add_rewrite_rule(
                $parent->slug . '/' . $term->slug . '/?$',
                'index.php?' . $taxonomy . '=' . $term->slug,
                'top'
            );

            // Phân trang /parent/child/page/2
            add_rewrite_rule(
                $parent->slug . '/' . $term->slug . '/page/([0-9]{1,})/?$',
                'index.php?' . $taxonomy . '=' . $term->slug . '&paged=$matches[1]',
                'top'
            );
        } else {
            // Category cha (root)
            add_rewrite_rule(
                $term->slug . '/?$',
                'index.php?' . $taxonomy . '=' . $term->slug,
                'top'
            );

            add_rewrite_rule(
                $term->slug . '/page/([0-9]{1,})/?$',
                'index.php?' . $taxonomy . '=' . $term->slug . '&paged=$matches[1]',
                'top'
            );
        }
    }
});

// Redirect 301 từ URL cũ /movie-category/... sang URL mới
add_action('template_redirect', function () {

    if (is_tax('danh_muc_file')) {

        $term = get_queried_object();
        if (! $term || is_wp_error($term)) return;

        $taxonomy = 'danh_muc_file';

        // Lấy URL mới đã rewrite
        $parent = $term->parent ? get_term($term->parent, $taxonomy) : null;

        if ($parent) {
            // Term con
            $new_url = home_url('/' . $parent->slug . '/' . $term->slug . '/');
        } else {
            // Term cha
            $new_url = home_url('/' . $term->slug . '/');
        }

        // URL hiện tại (old)
        $current_url  = home_url($_SERVER['REQUEST_URI']);

        // Nếu URL hiện tại chứa /movie-category/ → redirect vĩnh viễn
        if (strpos($current_url, '/files-category/') !== false) {
            wp_redirect($new_url, 301);
            exit;
        }
    }
});
// ------------------------------------------------------------------------------------------