<?php
// rewrite url danh mục của post mặc định, remove /category prefix
// ko cần Cài đặt > Cấu trúc đường dẫn > Đường dẫn danh mục
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<?php
// chứa cấu hình rewrite url cho project
// các bước wp xử lý url:
// 1️⃣ Admin Cài đặt cấu trúc đường dẫn / CPT UI config (rewrite, slug, has_archive…)
// 2️⃣ Core rewrite rules của WordPress
// 3️⃣ Custom rewrite_rule + rewrite_tag: Ưu tiên match sớm → xử lý request trước rule của Admin & CPT UI, giúp giữ SEO
// 4️⃣ Fallback → 404

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

/**
 * Filter xoá /category/ khỏi URL trả về từ WordPress
 */
add_filter('term_link', function ($url, $term, $taxonomy) {
    if ($taxonomy === 'category') {
        return home_url('/' . $term->slug . '/');
    }
    return $url;
}, 10, 3);
