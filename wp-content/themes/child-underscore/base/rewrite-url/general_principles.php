<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

Nguyên tắc chung khi viết rewrite url gồm các bước:
Tùy chọn: rewrite lại CPT prefix khi ko muốn can thiệp vào code export gốc từ CPT UI:
    add_action( 'init', function() {

        // Lấy đăng ký post type cũ
        $post_type = 'movie';

        // Lấy thông tin hiện tại của CPT
        $cpt = get_post_type_object( $post_type );
        if ( ! $cpt ) return;

        // Ghi đè rewrite slug thành "phim"
        $cpt->rewrite = [
            'slug'       => 'phim',
            'with_front' => false
        ];

        // Re-register lại CPT với rewrite mới
        register_post_type( $post_type, (array) $cpt );
    }, 20 );


init > add_rewrite_rule : Khai báo cấu trúc URL để WP hiểu request, có thể thêm query param
template_redirect: cách redirect url khi URL đã match rewrite rule
 *_link filter (post_link, post_type_link, term_link): Tạo URL đúng khi hiển thị permalink khi gọi get_permalink()