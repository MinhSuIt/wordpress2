<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<?php
$args = wp_parse_args($args ?? [], [
    'id' => '',
    'title'   => '',
    'template-content'  => '',
    'folder' => ''
]);
?>

<div class="custom-modal" id="<?php echo $args['id']; ?>">
    <div class="modal-content">
        <button class="modal-close" data-close>&times;</button>
        <h2><?php echo $args['title']; ?></h2>
        <?php get_template_part($args['folder'] . $args['template-content']) ?>
    </div>
</div>