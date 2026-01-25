<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<?php
$class = esc_attr($args['class'] ?? '');
$id = esc_attr($args['id'] ?? '');
$title = esc_attr($args['title'] ?? '');
?>

<a class="<?php echo $class; ?>" href="#<?php echo $id; ?>" id="scrollTo" title="<?php echo $title; ?>">↑</a>