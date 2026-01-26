<?php
if (!defined('ABSPATH')) exit;

$class = esc_attr($args['class'] ?? '');
unset($args['class']);
$list  = $args['atts'];

$begin_title = 'title-';
$begin_path  = 'path-';

/* Lấy title */
$titles = array_filter($list, fn($v, $k) => strpos($k, $begin_title) === 0, ARRAY_FILTER_USE_BOTH);

/* Lấy path */
$paths  = array_filter($list, fn($v, $k) => strpos($k, $begin_path) === 0, ARRAY_FILTER_USE_BOTH);

/* Gom về 1 mảng breadcrumb */
$breadcrumbs = [];

foreach ($titles as $key => $title) {
    $index = str_replace($begin_title, '', $key);

    $breadcrumbs[] = [
        'title' => $title,
        'path'  => $paths[$begin_path . $index] ?? '',
    ];
}
?>

<nav class="custom-breadcrumb<?php echo $class ? ' ' . $class : ''; ?>" aria-label="Breadcrumb">

    <?php foreach ($breadcrumbs as $i => $item): ?>

        <?php if ($i > 0): ?>
            <span class="separator">/</span>
        <?php endif; ?>

        <?php if (!empty($item['path']) && $i !== array_key_last($breadcrumbs)): ?>
            <a href="<?php echo esc_url($item['path']); ?>">
                <?php echo esc_html($item['title']); ?>
            </a>
        <?php else: ?>
            <span class="current">
                <?php echo esc_html($item['title']); ?>
            </span>
        <?php endif; ?>

    <?php endforeach; ?>

</nav>