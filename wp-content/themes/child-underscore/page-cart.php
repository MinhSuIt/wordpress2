<?php
/*
Template Name: Cart Page
*/
?>
<?php get_header(); ?>
<?php get_template_part('template-parts/breadcrumb'); ?>
<?php
echo do_shortcode('[woocommerce_cart]');
?>

<?php
get_sidebar();
get_footer();
?>