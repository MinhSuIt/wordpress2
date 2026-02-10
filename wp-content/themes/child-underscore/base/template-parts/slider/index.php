<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<?php
$class = esc_attr($args['class']);
$display_prev_next = esc_html($args['display_prev_next']);
$display_pagination = esc_html($args['display_pagination']);
$list  = $args['atts'] ?? [];
// var_dump($list);
$begin_title = 'title-';
$begin_img   = 'img-';
$begin_url   = 'url-';

$titles = array_filter($list, fn($v, $k) => strpos($k, $begin_title) === 0, ARRAY_FILTER_USE_BOTH);
$imgs   = array_filter($list, fn($v, $k) => strpos($k, $begin_img) === 0,   ARRAY_FILTER_USE_BOTH);
$urls   = array_filter($list, fn($v, $k) => strpos($k, $begin_url) === 0,   ARRAY_FILTER_USE_BOTH);
/* gom về 1 mảng slides */
$slides = [];

foreach ($imgs as $key => $img) {
    $index = str_replace($begin_img, '', $key); // vd: img-1 => 1

    $slides[$index] = [
        'img'   => $img,
        'title' => $titles[$begin_title . $index] ?? '',
        'url'   => $urls[$begin_url . $index] ?? '',
    ];
}
?>
<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <?php foreach ($slides as $slide): ?>
            <div class="swiper-slide">
                <?php if (!empty($slide['url']) || $slide['url'] != ''): ?>
                    <a href="<?php echo esc_url($slide['url']); ?>">
                    <?php endif; ?>
                    <img
                        src="<?php echo esc_url($slide['img']); ?>"
                        alt="<?php echo esc_attr($slide['title'] ?? ''); ?>">

                    <?php if (!empty($slide['url']) || $slide['url'] != ''): ?>
                    </a>
                <?php endif; ?>
                <?php if (!empty($slide['title']) || $slide['title'] != ''): ?>
                    <h3 class="title"><?php echo esc_html($slide['title']); ?></h3>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- thêm thuộc tính để check hiển thị pagination, button prev/next -->

    <?php
    if ($display_prev_next == "1") {
    ?>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    <?php
    }
    ?>
    <?php
    if ($display_pagination == "1") {
    ?>
        <div class="swiper-pagination"></div>
    <?php
    }
    ?>
</div>