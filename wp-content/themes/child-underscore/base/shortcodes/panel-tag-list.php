<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<?php
function panel_tag_list_shortcode($atts) {
    ob_start();
    get_template_part('base/template-parts/panel-tag-list/index');
    return ob_get_clean();
}
add_shortcode('panel_tag_list_shortcode', 'panel_tag_list_shortcode');
// Usage: 
// trong code: <?php echo do_shortcode('[panel_tag_list_shortcode]'); ?>