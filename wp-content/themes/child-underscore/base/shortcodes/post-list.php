<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<?php
function post_list_shortcode($atts)
{
    wp_enqueue_style(
        'post-list',
        get_stylesheet_directory_uri() . '/base/template-parts/post-list/style.css',
        array(), // dependency
        '1.0',
        'all' // media: all, screen, print
    );
    extract(shortcode_atts([
        'class'          => '', // để custom css
        'post_type'     => 'post', // để custom post type
        'cat_id'        => 1, // để custom category ID
        'items_per_row_desktop' => 4,  // số bài viết trên mỗi hàng
        'items_per_row_tablet' => 2,  // số bài viết trên mỗi hàng
        'items_per_row_mobile' => 1,  // số bài viết trên mỗi hàng
        'posts_per_page'   => 10, // tổng số bài viết hiển thị
    ], $atts), EXTR_SKIP);
    ob_start();

    get_template_part(
        'base/template-parts/post-list/index',
        null,
        compact('class', 'post_type', 'cat_id', 'items_per_row_desktop', 'items_per_row_tablet', 'items_per_row_mobile', 'posts_per_page') 
    );
    return ob_get_clean();
}
add_shortcode('post_list_shortcode', 'post_list_shortcode');
// <?php echo do_shortcode("[post_list_shortcode class='custom-class' post_type='post' cat_id='1' items_per_row='2' posts_per_page='6']");
?>
