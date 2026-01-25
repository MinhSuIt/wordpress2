<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<?php
$tags = get_tags(array(
    'orderby'    => 'count',
    'order'      => 'DESC',
    'hide_empty' => true
));
?>

<div class="panel-tag-list tag-panel">
    <div class="header">
        <span class="header-icon">🏷️</span>
        TAG PHỔ BIẾN
    </div>

    <ul class="list tag-badge-wrap">
        <?php if ($tags) : foreach ($tags as $tag) : ?>
            <li class="tag-item">
                <a class="tag-badge" href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>">
                    #<?php echo esc_html($tag->name); ?>
                </a>
            </li>
        <?php endforeach; endif; ?>
    </ul>
</div>