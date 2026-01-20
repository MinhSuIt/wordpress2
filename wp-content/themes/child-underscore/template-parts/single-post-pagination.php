<!-- the_post_navigation từ underscore cũng đc -->
<div class="col-lg-12 mb-5">
    <div class="posts-nav bg-white p-5 d-lg-flex d-md-flex justify-content-between ">

        <?php
        // Lấy bài trước
        $prev_post = get_previous_post();
        if (!empty($prev_post)): ?>
            <a class="post-prev align-items-center" href="<?php echo get_permalink($prev_post->ID); ?>" style="width: 50% !important;">
                <div class="posts-prev-item mb-4 mb-lg-0">
                    <span class="nav-posts-desc text-color">- Previous Post</span>
                    <h6 class="nav-posts-title mt-1">
                        <?php echo esc_html($prev_post->post_title); ?>
                    </h6>
                </div>
            </a>
        <?php else: ?>
            <div></div> <!-- giữ layout nếu không có post trước -->
        <?php endif; ?>

        <div class="border"></div>

        <?php
        // Lấy bài sau
        $next_post = get_next_post();
        if (!empty($next_post)): ?>
            <a class="posts-next text-right" href="<?php echo get_permalink($next_post->ID); ?>" style="width: 50% !important;">
                <div class="posts-next-item pt-4 pt-lg-0">
                    <span class="nav-posts-desc text-lg-right text-md-right text-color d-block">- Next Post</span>
                    <h6 class="nav-posts-title mt-1">
                        <?php echo esc_html($next_post->post_title); ?>
                    </h6>
                </div>
            </a>
        <?php else: ?>
            <div></div> <!-- giữ layout nếu không có post sau -->
        <?php endif; ?>

    </div>
</div>