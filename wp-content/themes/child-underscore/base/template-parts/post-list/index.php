<?php
if (!defined('ABSPATH')) {
    exit;
}

$class = $args['class'];
$post_type = $args['post_type'];
$cat_id = (int)$args['cat_id']; // đổi ID tại đây
$items_per_row_desktop = (int)$args['items_per_row_desktop'];
$items_per_row_tablet = (int)$args['items_per_row_tablet'];
$items_per_row_mobile = (int)$args['items_per_row_mobile'];
$posts_per_page = (int)$args['posts_per_page'];

// error_log('items_per_row_desktop: ' . $items_per_row_desktop);
// error_log('items_per_row_tablet: ' . $items_per_row_tablet);
// error_log('items_per_row_mobile: ' . $items_per_row_mobile);

$query = new WP_Query([
    'post_type'      => $post_type,
    'posts_per_page' => $posts_per_page,
    'post_status'    => 'publish',
    'cat'            => $cat_id,
]);
?>

<div class="post-grid<?php echo esc_attr(" post-grid-desktop-" . $items_per_row_desktop); ?><?php echo esc_attr(" post-grid-tablet-" . $items_per_row_tablet); ?><?php echo esc_attr(" post-grid-mobile-" . $items_per_row_mobile); ?><?php echo esc_attr(" $class"); ?>">
    <?php if ($query->have_posts()) : ?>
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <div class="post-card">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) :
                        $thumb_id = get_post_thumbnail_id();
                    ?>
                        <img class="post-thumb"
                            src="<?php echo esc_url(wp_get_attachment_image_url($thumb_id, 'medium_large')); ?>"
                            srcset="<?php echo esc_attr(wp_get_attachment_image_srcset($thumb_id, 'medium_large')); ?>"
                            sizes="<?php echo esc_attr(wp_get_attachment_image_sizes($thumb_id, 'medium_large')); ?>"
                            alt="<?php echo esc_attr(get_the_title()); ?>">
                    <?php else : ?>
                        <img class="post-thumb" src="https://via.placeholder.com/400x300?text=No+Image" alt="">
                    <?php endif; ?>
                </a>

                <div class="post-content">
                    <h3 class="post-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h3>

                    <p class="post-desc">
                        <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                    </p>
                </div>
            </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p>Không có bài viết nào.</p>
    <?php endif; ?>
</div>