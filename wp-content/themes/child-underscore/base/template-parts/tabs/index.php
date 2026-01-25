<?php
if (! defined('ABSPATH')) exit;

$class = esc_attr($args['class'] ?? '');
$list  = $args['atts'] ?? [];
$folder = $args['folder'] ?? '';

$begin_title    = 'title-';
$begin_template = 'tab-';

$titles = array_filter($list, fn($v, $k) => strpos($k, $begin_title) === 0, ARRAY_FILTER_USE_BOTH);
$tabs   = array_filter($list, fn($v, $k) => strpos($k, $begin_template) === 0, ARRAY_FILTER_USE_BOTH);

/* Gom về 1 mảng slides */
$slides = [];

foreach ($tabs as $key => $template) {
    $index = str_replace($begin_template, '', $key);

    $slides[] = [
        'template' => $template,
        'title'    => $titles[$begin_title . $index] ?? '',
    ];
}
?>

<div class="custom-tabs <?php echo esc_attr($class); ?>">

    <!-- Radios -->
    <?php
    $i = 1;
    foreach ($slides as $slide):
    ?>
        <input
            type="radio"
            name="tab"
            id="tab<?php echo $i; ?>"
            <?php if ($i === 1) echo 'checked'; ?>>
    <?php
        $i++;
    endforeach;
    ?>

    <!-- Labels -->
    <div class="tab-labels">
        <?php
        $i = 1;
        foreach ($slides as $slide):
        ?>
            <label for="tab<?php echo $i; ?>">
                <?php echo esc_html($slide['title']); ?>
            </label>
        <?php
            $i++;
        endforeach;
        ?>
    </div>

    <!-- Contents -->
    <div class="content">
        <?php
        $i = 1;
        foreach ($slides as $slide):
        ?>
            <div class="tab-content" id="content<?php echo $i; ?>">
                <?php get_template_part($folder . '/' . $slide['template']); ?>
            </div>
        <?php
            $i++;
        endforeach;
        ?>
    </div>

</div>