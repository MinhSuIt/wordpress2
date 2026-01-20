<div class="col-lg-4">
    <div class="sidebar-wrap">
        <div class="sidebar-widget search card p-4 mb-3 border-0">
            <?php
            get_template_part('template-parts/search-bar');
            ?>
        </div>

        <div class="sidebar-widget card border-0 mb-3">
            <img src="images/blog/blog-author.jpg" alt="" class="img-fluid">
            <div class="card-body p-4 text-center">
                <h5 class="mb-0 mt-4">Arther Conal</h5>
                <p>Digital Marketer</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt, dolore.</p>

                <ul class="list-inline author-socials">
                    <li class="list-inline-item mr-3">
                        <a href="#"><i class="fab fa-facebook-f text-muted"></i></a>
                    </li>
                    <li class="list-inline-item mr-3">
                        <a href="#"><i class="fab fa-twitter text-muted"></i></a>
                    </li>
                    <li class="list-inline-item mr-3">
                        <a href="#"><i class="fab fa-linkedin-in text-muted"></i></a>
                    </li>
                    <li class="list-inline-item mr-3">
                        <a href="#"><i class="fab fa-pinterest text-muted"></i></a>
                    </li>
                    <li class="list-inline-item mr-3">
                        <a href="#"><i class="fab fa-behance text-muted"></i></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="sidebar-widget latest-post card border-0 p-4 mb-3">
            <h5>Latest Posts</h5>

            <!-- <div class="media border-bottom py-3">
                            <a href="#"><img class="mr-4" src="images/blog/bt-3.jpg" alt=""></a>
                            <div class="media-body">
                                <h6 class="my-2"><a href="#">Thoughtful living in los Angeles</a></h6>
                                <span class="text-sm text-muted">03 Mar 2018</span>
                            </div>
                        </div> -->

            <?php
            $args = array(
                'post_type'      => 'post',      // Chỉ lấy post
                'posts_per_page' => 5,           // 5 bài mới nhất
                'orderby'        => 'date',      // Sắp xếp theo ngày
                'order'          => 'DESC',      // Mới nhất trước
            );

            $the_query = new WP_Query($args);

            if ($the_query->have_posts()) :
                while ($the_query->have_posts()) : $the_query->the_post();
                    $post_url = get_permalink();             // URL bài viết
                    $post_title = get_the_title();           // Tiêu đề
                    $post_date = get_the_date('d M Y');      // Ngày đăng
            ?>

                    <div class="media border-bottom py-3">
                        <a href="<?php echo esc_url($post_url); ?>">
                            <?php
                            if (has_post_thumbnail()) {
                                // Hiển thị featured image dạng thumbnail
                                the_post_thumbnail('thumbnail', array(
                                    'class' => 'mr-4',
                                    'style' => "width: 87px;height:auto",
                                    'alt'   => esc_attr($post_title)
                                ));
                            } else {
                                // Fallback nếu post không có ảnh
                            ?>
                                <img class="mr-4" style="width: 87px;height:auto" src="<?php echo get_template_directory_uri(); ?>/images/blog/bt-3.jpg" alt="<?php echo esc_attr($post_title); ?>">
                            <?php } ?>
                        </a>

                        <div class="media-body">
                            <h6 class="my-2">
                                <a href="<?php echo esc_url($post_url); ?>"><?php echo esc_html($post_title); ?></a>
                            </h6>
                            <span class="text-sm text-muted"><?php echo esc_html($post_date); ?></span>
                        </div>
                    </div>

            <?php endwhile;
                wp_reset_postdata();
            endif;
            ?>

        </div>

        <div class="sidebar-widget bg-white rounded tags p-4 mb-3">
            <h5 class="mb-4">Tags</h5>
            <!-- <a href="#">Web</a> -->
            <!-- <?php
                    $tags = get_the_tags();

                    if ($tags) :
                        foreach ($tags as $tag) : ?>
                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>">
                        <?php echo esc_html($tag->name); ?>
                    </a>
            <?php endforeach;
                    endif;
            ?> -->
            <?php
            // tất cả các tag hiện có
            $tags = get_tags([
                'hide_empty' => false
            ]);

            if ($tags) {
                foreach ($tags as $tag) {
                    $tag_link = get_tag_link($tag->term_id);
                    echo '<a href="' . esc_url($tag_link) . '">' . esc_html($tag->name) . '</a> ';
                }
            }
            ?>

        </div>
    </div>
</div>