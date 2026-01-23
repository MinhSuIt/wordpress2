<!-- require vào functions.php nếu cần dùng -->
<?php
function tag_list_shortcode($atts) {
    ob_start();
    get_template_part('base/template-parts/tag-list/index');
    return ob_get_clean();
}
add_shortcode('tag_list_shortcode', 'tag_list_shortcode');
// Usage: 
// trong code: <?php echo do_shortcode('[tag_list_shortcode]'); ?>
<!-- // trong trình soạn thảo: [tag_list_shortcode] -->