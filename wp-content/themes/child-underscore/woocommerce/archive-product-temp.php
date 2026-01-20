<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined('ABSPATH') || exit;

get_header('shop');

get_template_part('template-parts/breadcrumb');
// wc_get_template dùng cho thư mục woocommerce: 
// wc_get_template( 'product.php' );
// child-theme/woocommerce/product.php

// do_action( 'custom_woocommerce_sidebar' ); // sidebar chung cho cả blog và woocommerce

dynamic_sidebar('shop-sidebar'); // kéo thả widget trong admin

// echo do_shortcode('[products limit="8" columns="4"]');
?>
<div class="container">
  <div class="shop-layout">

    <!-- CONTENT -->
    <main class="shop-content">
      <?php do_action('woocommerce_before_shop_loop'); ?>
      <?php
      // Pagination
      $paged = get_query_var('paged') ? get_query_var('paged') : 1;

      // Query products
      $args = [
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => 12,
        'paged'          => $paged,
      ];

      $products = new WP_Query($args);

      if ($products->have_posts()) :
      ?>

        <ul class="products-grid">

          <?php while ($products->have_posts()) : $products->the_post(); ?>
            <?php global $product; ?>

            <li class="product-card">

              <a href="<?php the_permalink(); ?>" class="product-thumb">
                <?php
                if (has_post_thumbnail()) {
                  the_post_thumbnail('medium');
                }
                ?>
              </a>

              <h2 class="product-title">
                <a href="<?php the_permalink(); ?>">
                  <?php the_title(); ?>
                </a>
              </h2>

              <span class="product-price">
                <?php echo $product->get_price_html(); ?>
              </span>

              <a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
                class="btn-add-to-cart">
                Add to cart
              </a>

            </li>
          <?php endwhile; ?>

        </ul>

        <!-- PAGINATION -->
        <div class="shop-pagination">
          <?php
          do_action('woocommerce_after_shop_loop');
          ?>
        </div>

      <?php
      else :
        echo '<p>No products found</p>';
      endif;

      wp_reset_postdata();
      ?>

    </main>

    <!-- SIDEBAR -->
    <?php get_sidebar('shop'); ?>

  </div>
</div>
<?php
get_footer('shop');
?>