<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<?php
$class = esc_attr($args['class'] ?? '');
$query = $args['query'] ?? null;
$paged = $args['paged'] ?? 1;
$should_show_pagination = (isset($args['should_show_pagination']) && $args['should_show_pagination'] == "1") ? true : false;

?>

<div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
    <?php
    $i = 1;
    if ($query && $query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $thumb_id = get_post_thumbnail_id(get_the_ID());
            $srcset = wp_get_attachment_image_srcset($thumb_id);
    ?>
            <?php echo do_shortcode(
                "[base_item_2_shortcode 
                    class='ss' 
                    heading='h3' 
                    title='" . get_the_title() . "' 
                    description='" . get_the_excerpt() . "'
                    img='" . (has_post_thumbnail() ? esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')) : get_template_directory_uri() . '/assets/images/no-image.png') . "'
                    url='" . get_the_permalink() . "'
                    srcset='" . $srcset . "'
                    ]"
            );
            ?>

    <?php
            $i++;
        endwhile;
        wp_reset_postdata();
    else :
        get_template_part("base/template-parts/content/content-none");
    endif;
    ?>
</div>
<?php
if ($should_show_pagination && $query && $query->max_num_pages > 1) {
    $max_num_pages = $query->max_num_pages;
    echo do_shortcode(
        '[base_pagination_shortcode 
            total="' . $max_num_pages . '" 
            base="' . esc_url(str_replace(999999999, '%#%', get_pagenum_link(999999999))) . '" 
            current="' . $paged . '"
        ]'
    );
}
?>