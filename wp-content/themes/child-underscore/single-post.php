<?php
/*
Template Name: Pricing Page
*/
?>
<!-- Tạo page trong admin rồi vào chỉnh sửa nhanh chọn Mẫu trang là template này, Đường dẫn là pricing (/pricing)
Thêm vào menu dạng page Pricing
Nếu truy cập /pricing ko được thì vào cài đặt > cấu trúc đường dẫn > Tiêu đề bài viết  -->

<?php get_header(); ?>

<?php get_template_part('template-parts/breadcrumb'); ?>


<section class="section blog-wrap bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <?php
                    while (have_posts()) :
                        the_post();

                        get_template_part('template-parts/single-post-content', get_post_type());

                    endwhile; // End of the loop.
                    ?>
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