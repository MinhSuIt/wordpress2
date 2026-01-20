<?php
// Ngăn truy cập trực tiếp
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
// export code từ Custom post type UI và advanced custom fields
function cptui_register_my_cpts()
{

    /**
     * Post Type: Testimonials.
     */

    $labels = [
        "name" => esc_html__("Testimonials", "child-underscore"),
        "singular_name" => esc_html__("Testimonial", "child-underscore"),
    ];

    $args = [
        "label" => esc_html__("Testimonials", "child-underscore"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "can_export" => false,
        "rewrite" => ["slug" => "testimonial", "with_front" => true],
        "query_var" => true,
        "supports" => ["title", "editor", "thumbnail"],
        "show_in_graphql" => false,
    ];

    register_post_type("testimonial", $args);
}

add_action('init', 'cptui_register_my_cpts');

function cptui_register_my_taxes()
{

    /**
     * Taxonomy: Đánh giá.
     */

    $labels = [
        "name" => esc_html__("Đánh giá", "child-underscore"),
        "singular_name" => esc_html__("Đánh giá", "child-underscore"),
    ];


    $args = [
        "label" => esc_html__("Đánh giá", "child-underscore"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => false,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => ['slug' => 'rate', 'with_front' => true,],
        "show_admin_column" => false,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "rate",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "rest_namespace" => "wp/v2",
        "show_in_quick_edit" => false,
        "sort" => false,
        "show_in_graphql" => false,
    ];
    register_taxonomy("rate", ["testimonial"], $args);
}
add_action('init', 'cptui_register_my_taxes');

add_action('acf/include_fields', function () {
    if (! function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_6957f7d93d77d',
        'title' => 'Testimonial Fields',
        'fields' => array(
            array(
                'key' => 'field_6957f82368894',
                'label' => 'Name',
                'name' => 'name',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'maxlength' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_6957f85168895',
                'label' => 'Job',
                'name' => 'job',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'maxlength' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_6957f89168896',
                'label' => 'Comment',
                'name' => 'comment',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'maxlength' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'testimonial',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
        'display_title' => '',
    ));
});


// chỉnh sửa cho các trang admin custom post type ui
// Thêm các cột vào trang danh sách CPT 'testimonial' trong Admin
function add_testimonial_columns($columns)
{
    // Thêm các cột 'name', 'job', 'comment' vào
    $columns['testimonial_name'] = 'Name';
    $columns['testimonial_job'] = 'Job';
    $columns['testimonial_comment'] = 'Comment';

    // Xóa cột 'date' khỏi mảng cột
    unset($columns['date']);

    return $columns;
}
add_filter('manage_testimonial_posts_columns', 'add_testimonial_columns');

// Hiển thị dữ liệu trong các cột tùy chỉnh
function custom_testimonial_columns($column, $post_id)
{
    switch ($column) {
        case 'testimonial_name':
            // Lấy trường 'name' từ ACF và hiển thị
            $name = get_field('name', $post_id);
            echo esc_html($name);
            break;

        case 'testimonial_job':
            // Lấy trường 'job' từ ACF và hiển thị
            $job = get_field('job', $post_id);
            echo esc_html($job);
            break;

        case 'testimonial_comment':
            // Lấy trường 'comment' từ ACF và hiển thị
            $comment = get_field('comment', $post_id);
            echo esc_html($comment);
            break;
    }
}
add_action('manage_testimonial_posts_custom_column', 'custom_testimonial_columns', 10, 2);


// Thêm cột "Rate" vào trang danh sách bài viết của CPT 'testimonial' trong Admin
function add_testimonial_rate_column($columns) {
    // Thêm cột "Rate" (hoặc tên khác nếu bạn muốn)
    $columns['testimonial_rate'] = 'Rate';

    return $columns;
}
add_filter('manage_testimonial_posts_columns', 'add_testimonial_rate_column');

// Hiển thị dữ liệu của taxonomy "rate" trong cột đã thêm
function custom_testimonial_rate_column($column, $post_id) {
    switch ($column) {
        case 'testimonial_rate':
            // Lấy taxonomy "rate" gắn với bài viết
            $terms = get_the_terms($post_id, 'rate'); // 'rate' là tên của taxonomy
            if ($terms && !is_wp_error($terms)) {
                $term_list = array();
                foreach ($terms as $term) {
                    $term_list[] = $term->name; // Lấy tên của taxonomy
                }
                echo implode(', ', $term_list); // Hiển thị danh sách các taxonomy gắn với bài viết
            } else {
                echo 'No Rate'; // Nếu không có taxonomy 'rate' gắn với bài viết
            }
            break;
    }
}
add_action('manage_testimonial_posts_custom_column', 'custom_testimonial_rate_column', 10, 2);
