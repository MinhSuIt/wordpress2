<!-- require vào functions.php nếu cần dùng -->
<?php
function post_list_shortcode($atts) {
    ob_start();
    get_template_part('base/template-parts/post-list/index');
    return ob_get_clean();
}
add_shortcode('post_list_shortcode', 'post_list_shortcode');
// Usage: <?php echo do_shortcode('[post_list_shortcode]'); ?>