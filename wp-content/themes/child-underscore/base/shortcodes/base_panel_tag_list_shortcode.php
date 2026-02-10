<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<?php
function base_panel_tag_list_shortcode($atts) {
    wp_enqueue_style(
        'panel-tag-list',
        get_stylesheet_directory_uri() . '/base/template-parts/panel-tag-list/style.css',
        array(), // dependency
        wp_get_theme()->get('Version'),
        'all' // media: all, screen, print
    );
    ob_start();
    get_template_part('base/template-parts/panel-tag-list/index');
    return ob_get_clean();
}
add_shortcode('base_panel_tag_list_shortcode', 'base_panel_tag_list_shortcode');
// Usage: 
// trong code: <?php echo do_shortcode('[base_panel_tag_list_shortcode]'); ?>