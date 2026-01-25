<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<!-- get_template_part('base/template-parts/post-list/index'); -->
<?php
$class = esc_attr($args['class'] ?? '');
$query = $args['query'] ?? null;
?>

<div class="panel-post-list<?php echo " " . $class; ?>">
    <div class="header">
        <span class="header-icon"><img draggable="false" role="img" class="emoji" alt="🔥" src="https://s.w.org/images/core/emoji/17.0.2/svg/1f525.svg"></span>
        TOP 10 TẢI APP THÁNG
    </div>

    <ul class="list">
        <?php
        $i = 1;
        if ($query && $query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                $views = get_post_meta(get_the_ID(), 'post_views_count', true);
        ?>

                <?php if ($i <= 3) : ?>
                    <!-- Top 3 -->
                    <li class="list-item top-3">
                        <div class="item-number"><?php echo $i; ?></div>
                        <?php
                        if (has_post_thumbnail()) {
                        ?>
                            <!-- hoặc 'medium', 'full' -->
                            <img style="width:70px;aspect-ratio:4/3;object-fit:cover;" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'thumbnail')); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                        <?php
                        } else {
                            echo '<img style="width:70px;aspect-ratio:4/3;object-fit:cover;" src="' . get_template_directory_uri() . '/assets/images/no-image.png" alt="no image">';
                        }
                        ?>
                        <div class="item-content">
                            <h3 class="item-title">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <div class="item-description"><?php echo get_the_category_list(', '); ?></div>
                        </div>
                    </li>
                <?php else : ?>
                    <!-- 4 - 10 -->
                    <li class="list-item regular">
                        <div class="item-number gray"><?php echo $i; ?></div>
                        <div class="item-content">
                            <div class="item-title"><?php the_title(); ?></div>
                        </div>
                        <div class="item-downloads">Lượt xem: <?php echo number_format_i18n($views); ?></div>
                    </li>
                <?php endif; ?>

        <?php
                $i++;
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </ul>
</div>