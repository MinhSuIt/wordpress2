<?php
if (!defined('ABSPATH')) exit;
?>

<?php
$class = esc_attr($args['class']);
$img = esc_attr($args['img']);
$heading = esc_html($args['heading']);
$title = esc_html($args['title']);
$description = esc_html($args['description']);
$url = esc_url($args['url']);
$srcset = esc_attr($args['srcset']);
?>
<a href="<?php echo $url; ?>">
    <div class="group rounded-lg overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-2xl cursor-pointer">
        <div class="relative">
                <!-- srcset="<?php echo $srcset; ?>" -->
                <!-- sizes="(max-width: 768px) 100vw, 300px"  -->
            <img 
                src="<?php echo $img; ?>" 
                alt="<?php echo $title; ?>" 
                class="w-full !h-48 object-cover">
        </div>
        <div class="p-4 bg-slate-900 h-[72px]">
            <div class="flex items-center gap-3">
                <div class="flex-1 min-w-0">
                    <<?= $heading ?> class="!text-base !font-semibold !text-slate-100 !leading-tight !line-clamp-2 !m-0"><?php echo $title; ?></<?= $heading ?>>
                </div>
            </div>
            <?php if (!empty($description)) : ?>
                <div class="!text-sm !text-gray-400 !line-clamp-2">
                    <?php echo htmlspecialchars($description); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</a>