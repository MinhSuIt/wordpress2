<?php
/*
Template Name: Blog Page
*/
?>
<!-- Tạo page trong admin rồi vào chỉnh sửa nhanh chọn Mẫu trang là template này, Đường dẫn là blog (/blog)
Thêm vào menu dạng page Blog
Nếu truy cập /blog ko được thì vào cài đặt > cấu trúc đường dẫn > Tiêu đề bài viết  -->

<?php get_header(); ?>
<?php get_template_part('template-parts/breadcrumb'); ?>

<section class="section blog-wrap bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="row">
                        <?php
                        $posts_per_page = get_option('posts_per_page'); // theo cấu hình read mặc định 10 post
                        // $posts_per_page = 1;
                        // Lấy trang hiện tại
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        // Tạo query để lấy bài viết
                        $blog_query = new WP_Query(array(
                            'post_type' => 'post',      // Chỉ lấy bài viết
                            'posts_per_page' => $posts_per_page,      // Số bài muốn hiển thị
                            'paged'          => $paged, // rất quan trọng để phân trang
                        ));

                        if ($blog_query->have_posts()) :
                            while ($blog_query->have_posts()) : $blog_query->the_post(); ?>

                                <div class="col-lg-6 col-md-6 mb-5">
                                    <div class="blog-item">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>" class="img-fluid rounded">
                                        <?php else: ?>
                                            <img src="images/blog/1.jpg" alt="<?php the_title(); ?>" class="img-fluid rounded">
                                        <?php endif; ?>

                                        <div class="blog-item-content bg-white p-4">
                                            <div class="blog-item-meta py-1 px-2">
                                                <?php
                                                // Lấy category đầu tiên của bài viết
                                                $category = get_the_category();
                                                if (! empty($category)) {
                                                    echo '<span class="text-muted text-capitalize mr-3"><i class="ti-pencil-alt mr-2"></i>'
                                                        . esc_html($category[0]->name) . '</span>';
                                                }
                                                ?>
                                            </div>

                                            <h3 class="mt-3 mb-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <p class="mb-4" style="height:90px"><?php echo wp_trim_words(Helper::get_description(), 10, '...'); ?></p>
                                            <!-- <p class="mb-4 text-truncate" style="height:90px"><?php echo Helper::get_description(); ?></p> -->

                                            <a href="<?php the_permalink(); ?>" class="btn btn-small btn-main btn-round-full">Learn More</a>
                                        </div>
                                    </div>
                                </div>

                        <?php endwhile;
                            wp_reset_postdata();
                        else :
                            echo '<p>No posts found.</p>';
                        endif;
                        ?>
                    </div>

                </div>
                <!-- <div class="row mt-5">
            <div class="col-lg-8">
                <nav class="navigation pagination py-2 d-inline-block">
                    <div class="nav-links">
                        <a class="prev page-numbers" href="#">Prev</a>
                        <span aria-current="page" class="page-numbers current">1</span>
                        <a class="page-numbers" href="#">2</a>
                        <a class="next page-numbers" href="#">Next</a>
                    </div>
                </nav>
            </div>
        </div> -->
                <div class="row mt-5">
                    <div class="col-lg-8">
                        <nav class="navigation pagination py-2 d-inline-block">
                            <div class="nav-links">
                                <?php
                                // Các tham số phân trang
                                $big = 999999999; // cần cho str_replace
                                echo paginate_links(array(
                                    'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                                    'format'    => '?paged=%#%',
                                    'current'   => max(1, get_query_var('paged')),
                                    'total'     => $blog_query->max_num_pages,
                                    'prev_text' => 'Prev',
                                    'next_text' => 'Next',
                                    // 'type'      => 'list', // tạo <ul><li> giống HTML
                                    'type'      => 'plain', // nếu chỉ thẻ a
                                ));
                                ?>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <?php get_template_part('template-parts/sidebar-blog'); ?>

        </div>



    </div>
</section>

<?php
get_sidebar();
get_footer();
?>