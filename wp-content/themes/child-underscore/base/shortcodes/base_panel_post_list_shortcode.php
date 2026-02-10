<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<?php
// top view dựa theo plugin post-views-counter
function base_panel_post_list_shortcode($atts)
{
    wp_enqueue_style(
        'panel-post-list',
        get_stylesheet_directory_uri() . '/base/template-parts/panel-post-list/style.css',
        array(), // dependency
        wp_get_theme()->get('Version'),
        'all' // media: all, screen, print
    );
    extract(shortcode_atts([
        'post_type'      => 'post',
        'posts_per_page' => 10,
        // 'orderby'        => 'date',
        'orderby' => 'post_views',
        'order'          => 'DESC',
        'class'          => '' // để custom css
    ], $atts), EXTR_SKIP);
    $queryArgs = [
        'post_type'      => $post_type,
        'posts_per_page' => $posts_per_page,
        'orderby'        => $orderby,
        'order'          => $order
    ];
    $query = new WP_Query($queryArgs);
    ob_start();
    get_template_part(
        'base/template-parts/panel-post-list/index',
        null,
        compact('query', 'class') // ~ ['query' => $query,'class' => $class]
    );
    return ob_get_clean();
}
add_shortcode('base_panel_post_list_shortcode', 'base_panel_post_list_shortcode');
// <?php echo do_shortcode("[base_panel_post_list_shortcode class='custom-class' post_type='post' posts_per_page=2 meta_key='post_views_count' orderby='meta_value_num' order='DESC']"); 
?>
