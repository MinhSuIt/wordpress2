<?php
function render_pagination(array $args = [])
{
    $args = wp_parse_args($args, [
        'current'   => 1,
        'total'     => 1,
        'base'      => '',
        'prev_text' => '«',
        'next_text' => '»',
    ]);

    if ($args['total'] <= 1 || empty($args['base'])) {
        return '';
    }

    return '<div class="custom-pagination">' . paginate_links([
        'base'      => $args['base'],
        'format'    => $args['format'],
        'current'   => max(1, (int) $args['current']),
        'total'     => (int) $args['total'],
        'prev_text' => $args['prev_text'],
        'next_text' => $args['next_text'],
        'type'      => 'plain',
    ]) .
        '</div>';
}

add_shortcode('base_pagination_shortcode', function ($atts) {
    global $wp_query;

    if (! $wp_query instanceof WP_Query) {
        return '';
    }
    wp_enqueue_style(
        'pagination',
        get_stylesheet_directory_uri() . '/base/template-parts/pagination/style.css',
        array(), // dependency
        wp_get_theme()->get('Version'),
        'all' // media: all, screen, print
    );
    return render_pagination([
        'current' => $atts['current'],
        'total'   => (int) $atts['total'],
        'base'    => $atts['base'],
        'format'    => '?paged=%#%',
    ]);
});

// Sử dụng:

// $posts_per_page = get_option('posts_per_page'); // theo cấu hình read mặc định 10 post
// $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
// $blog_query = new WP_Query(array(
//     'post_type' => 'post',      // Chỉ lấy bài viết
//     'posts_per_page' => 1,      // Số bài muốn hiển thị
//     'paged'          => $paged, // rất quan trọng để phân trang
// ));

// echo do_shortcode("[base_pagination_shortcode total=" . $blog_query->max_num_pages . " base=" . str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))) . " current=" . max(1, get_query_var('paged')) . "]");
