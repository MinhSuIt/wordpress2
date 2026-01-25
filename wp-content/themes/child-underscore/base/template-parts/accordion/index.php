    <?php
    if (! defined('ABSPATH')) {
        exit; // Exit if accessed directly
    }
    ?>
    <?php
    $class = $args['class'];
    $folder = $args['folder']; // từ theme hiện tại
    // $folder = "base/template-parts/accordion/"; // từ theme hiện tại
    $list = $args['atts'];
    $begin_title = 'title-';
    $begin_template = 'template-';
    $filtered = array_filter($list, function ($value, $key) use ($begin_title) {
        return strpos($key, $begin_title) === 0;
    }, ARRAY_FILTER_USE_BOTH);
    ?>
    <div class="accordion">
        <?php $i = 1;
        foreach ($filtered as $key => $title) {
        ?>
            <div class="accordion-item">
                <button class="accordion-header">
                    <?php echo $list[$begin_title . "$i"]; ?>
                    <span class="icon">+</span>
                </button>
                <div class="accordion-content">
                    <?php get_template_part("$folder" . $list["$begin_template$i"]); ?>
                </div>
            </div>
        <?php $i++;
        } ?>
    </div>