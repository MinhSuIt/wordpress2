<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<?php
$args = wp_parse_args($args ?? [], [
    'progress' => '',
    'class' => '',
]);
?>
<div class="<?php echo $args['class'] ?>" style="--progress: <?php echo $args['progress']; ?>;">
    <div class="progress-container">
        <div class="progress-bar"></div>
    </div>
</div>