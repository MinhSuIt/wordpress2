<?php
if (!defined('ABSPATH')) {
    exit;
}
// echo gettype($var);
$class = $args['class'];
$list = $args['list'];

// var_dump($args);
?>

<div class="gallery-custom<?php echo esc_attr(" " . $class); ?>" id="gallery-custom">
    <?php
    foreach ($list as $value) {
    ?>
        <img
            src="<?php echo esc_attr($value['thumbnail']); ?>"
            srcset="<?php echo esc_attr($value['thumbnail']); ?> 600w, <?php echo esc_attr($value['lightbox']); ?> 1536w"
            srcLightbox="<?php echo esc_attr($value['lightbox']); ?>" alt="Gallery Image">
    <?php
    }
    ?>
</div>

<!-- LIGHTBOX -->
<div class="lightbox" id="lightbox">
    <button class="lightbox-close" id="closeBtn" aria-label="Close">
        <span>×</span>
    </button>
    <span class="prev" id="prevBtn">&#10094;</span>
    <img id="lightboxImg" src="">
    <span class="next" id="nextBtn">&#10095;</span>
</div>