<?php
if (!defined('ABSPATH')) {
    exit;
}
function base_items_1_shortcode($atts)
{
    extract(shortcode_atts([
        'post_type'      => 'post',
        'posts_per_page' => get_option('posts_per_page'), // mặc định lấy từ cấu hình từ admin
        'orderby'        => 'date',
        'order'          => 'DESC',
        'class'          => '', // để custom css
        'paged'         => 1,
        'should_show_pagination'       => '0',

        // filter taxonomy
        'taxonomy_name' => '', // tên taxonomy
        'taxonomy_value' => '', // giá trị term_id tìm của taxonomy
        'taxonomy_field'    => 'term_id',

    ], $atts), EXTR_SKIP);
    $queryArgs = [
        'post_type'      => $post_type,
        'posts_per_page' => $posts_per_page,
        'orderby'        => $orderby,
        'order'          => $order,
        'paged'          => $paged,
    ];
    // lọc theo taxonomy
    $tax_query = [];

    if (!empty($taxonomy_name) && !empty($taxonomy_value)) {
        $tax_query[] = [
            'taxonomy' => $taxonomy_name,
            'field'    => $taxonomy_field,
            'terms'    => array_map('trim', explode(',', $taxonomy_value)),
        ];
        $queryArgs['tax_query'] = $tax_query;
    }
    // end lọc theo taxonomy
    $query = new WP_Query($queryArgs);
    ob_start();
    get_template_part('base/template-parts/items-1/index', null, compact('query', 'class', 'should_show_pagination', 'paged'));
    return ob_get_clean();
}

add_shortcode('base_items_1_shortcode', 'base_items_1_shortcode');
