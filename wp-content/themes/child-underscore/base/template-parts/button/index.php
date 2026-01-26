<?php
if (!defined('ABSPATH')) exit;
?>

<?php
$args = wp_parse_args($args ?? [], [
    'url'   => '#',
    'text'  => 'Click me',
    'class' => '',
    'type' => 'button' // button/a a là thẻ a button là thẻ button
]);

$class = 'custom-btn';
$class .= $args['class'] ? " " . $args['class'] :  '';
$url = $args['url'];
$text = esc_html($args['text']);

unset($args['url']);
unset($args['class']);
unset($args['text']);
?>

<<?php echo $args['type'] ?> href="<?php echo esc_url($url); ?>"
   class="<?php echo esc_attr($class); ?>"
   <?php if (!empty($args['data-modal-target'])) : ?>
       data-modal-target="<?php echo esc_attr($args['data-modal-target']); ?>"
   <?php endif; ?>
>
    <?php echo $text; ?>
</<?php echo $args['type'] ?>>