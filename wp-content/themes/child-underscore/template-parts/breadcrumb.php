<?php
if (
    ! is_page() &&
    ! is_single() &&
    ! is_shop() &&
    ! is_product_category() &&
    ! is_product() && 
    ! is_archive() 
) return;
?>
<section class="page-title bg-1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block text-center">
                    <?php
                    if (is_page()) {
                        // echo '<span class="text-white">Page</span>';
                        echo '<h1 class="text-capitalize mb-4 text-lg">' . get_the_title() . '</h1>';
                    } elseif (is_single()) {
                        // echo '<span class="text-white">Blog</span>';
                        echo '<h1 class="text-capitalize mb-4 text-lg">' . get_the_title() . '</h1>';
                    } elseif (is_shop()) {
                        // echo '<span class="text-white">Blog</span>';
                        echo '<h1 class="text-capitalize mb-4 text-lg">' . woocommerce_page_title(false) . '</h1>';
                    }
                    ?>
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="<?php echo home_url(); ?>" class="text-white">Home</a></li>
                        <li class="list-inline-item"><span class="text-white">/</span></li>
                        <?php
                        if (is_page()) {
                            global $post;
                            if ($post->post_parent) {
                                $ancestors = get_post_ancestors($post->ID);
                                $ancestors = array_reverse($ancestors);
                                foreach ($ancestors as $ancestor) {
                                    echo '<li class="list-inline-item"><a href="' . get_permalink($ancestor) . '" class="text-white-50">' . get_the_title($ancestor) . '</a></li>';
                                    echo '<li class="list-inline-item"><span class="text-white">/</span></li>';
                                }
                            }
                            echo '<li class="list-inline-item"><a href="' . get_permalink() . '" class="text-white-50">' . get_the_title() . '</a></li>';
                        } elseif (is_shop()) {
                            echo '<li class="list-inline-item"><a href="' . wc_get_page_permalink( 'shop' ) . '" class="text-white-50">' . woocommerce_page_title(false) . '</a></li>';
                        }

                        if (is_single()) {
                            $categories = get_the_category();
                            if ($categories) {
                                $category = $categories[0];
                                echo '<li class="list-inline-item"><a href="' . get_category_link($category->term_id) . '" class="text-white-50">' . $category->name . '</a></li>';
                                echo '<li class="list-inline-item"><span class="text-white">/</span></li>';
                            }
                            echo '<li class="list-inline-item"><a href="' . get_permalink() . '" class="text-white-50">' . get_the_title() . '</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>