<?php
if (!defined('ABSPATH')) exit;
?>

<?php
$class = esc_attr($args['class']);
$img = esc_attr($args['img']);
$heading = esc_html($args['heading']);
$title = esc_html($args['title']);
$description = esc_html($args['description']);
$url = esc_html($args['url']);
$srcset = esc_attr($args['srcset']);
?>
<a href="<?php echo $url; ?>" class="block">
    <div class="group cursor-pointer transition-all duration-300 hover:scale-105 text-center flex flex-col gap-3">
        <div class="relative overflow-hidden rounded-2xl m-0 w-full">
            <!-- srcset="<?php echo $srcset; ?>" -->
            <!-- sizes="(max-width: 768px) 100vw, 300px"  -->
            <img
                src="<?php echo $img; ?>"
                alt="<?php echo $title; ?>"
                class="w-full !h-72 object-cover">
        </div>

        <<?= $heading ?>
            class="text-white font-bold text-lg mb-1 group-hover:text-amber-400 transition-colors line-clamp-2 !m-0 px-2">
            <?php echo $title; ?>
        </<?= $heading ?>>

        <?php if (!empty($description)) : ?>
            <p class="text-slate-400 text-sm line-clamp-2 !m-0 px-2">
                <?php echo $description; ?>
            </p>
        <?php endif; ?>
    </div>
</a>