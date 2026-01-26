<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<?php
$class = esc_attr($args['class'] ?? '');
$list  = $args['atts'] ?? [];

$folder  = $args['folder'];

$begin_title    = 'title-';
$begin_template = 'template-';

$titles = array_filter($list, fn($v, $k) => strpos($k, $begin_title) === 0, ARRAY_FILTER_USE_BOTH);
$templates   = array_filter($list, fn($v, $k) => strpos($k, $begin_template) === 0, ARRAY_FILTER_USE_BOTH);

$slides = [];
$i = 1;
foreach ($templates as $key => $template) {
    $slides[] = [
        'template' => $template,
        'title'    => $list[$begin_title . $i] ?? '',
    ];
    $i++;
}
?>
<?php
foreach ($slides as $key => $slide) {
?>
    <details class="custom-collapse">
        <summary><?php echo $slide['title'] ?></summary>
        <div class="collapse-content">
            <?php get_template_part($folder . $slide['template']); ?>
        </div>
    </details>
<?php } ?>