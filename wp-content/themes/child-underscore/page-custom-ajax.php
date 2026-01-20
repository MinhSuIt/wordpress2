<?php
/*
Template Name: Custom Ajax Page
*/
?>

<?php get_header(); ?>

<div id="post-list">
    <?php
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 6,
        'paged' => 1
    );
    $query = new WP_Query($args);

    if ($query->have_posts()):
        while ($query->have_posts()): $query->the_post();
    ?>
            <div class="post-item">
                <h3><?php the_title(); ?></h3>
            </div>
    <?php
        endwhile;
    endif;
    wp_reset_postdata();
    ?>
</div>

<button id="load-more">Load more</button>


<?php echo do_shortcode('[woo_product_filter]'); ?>


<?php get_footer(); ?>
    