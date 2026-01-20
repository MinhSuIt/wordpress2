<?php
// Ngăn truy cập trực tiếp
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
// Cả user logged in và guest đều có thể gửi
// khai báo 2 hook:
// add_action('admin_post_nopriv_???', 'handle_???');
// add_action('admin_post_???', 'handle_???');

add_action('admin_post_nopriv_save_custom_testimonial', 'handle_save_custom_testimonial');
add_action('admin_post_save_custom_testimonial', 'handle_save_custom_testimonial');

function handle_save_custom_testimonial()
{
    error_log("handle_save_custom_testimonial");
    if (
        !isset($_POST['testimonial_nonce']) ||
        !wp_verify_nonce($_POST['testimonial_nonce'], 'submit_testimonial_action')
    ) {
        error_log('Lỗi bảo mật handle_save_custom_testimonial');
        wp_die('Lỗi bảo mật');
    }

    $name    = sanitize_text_field($_POST['name']);
    $job     = sanitize_text_field($_POST['job']);
    $comment = sanitize_textarea_field($_POST['comment']);
    $rate    = intval($_POST['rate']);
    $post_id = wp_insert_post([
        'post_type'   => 'testimonial',
        'post_title'  => $name,
        'post_status' => 'publish',
    ]);

    if ($post_id) {
        update_field('name', $name, $post_id); // cho advanced custom fields
        update_field('job', $job, $post_id);
        update_field('comment', $comment, $post_id);
        wp_set_object_terms($post_id, $rate, 'rate'); // cho taxonomy của custom post type
    }

    wp_redirect(home_url('/')); // redirect
    exit;
}
