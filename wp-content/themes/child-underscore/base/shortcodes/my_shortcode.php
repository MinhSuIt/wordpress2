<?php
function my_shortcode($atts, $content = null)
{
    wp_enqueue_style('my-css', get_stylesheet_directory_uri() . '/base/template-parts/my_shortcode/style.css');
    wp_enqueue_script('my-js', get_stylesheet_directory_uri() . '/base/template-parts/my_shortcode/js.js', [], '1.0', ['strategy' => 'defer']);

    ob_start(); ?>
    <div class="my-box">
        <?php echo do_shortcode($content); ?>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('my_shortcode', 'my_shortcode');



add_action('ux_builder_setup', function () {
    add_ux_builder_shortcode('my_shortcode', [
        'name'      => 'My Shortcode',
        'category'  => 'Content',
        'type'      => 'container', // 👈 rất quan trọng
        'wrap'      => false,
        'allow'     => 'all',
        'options'   => [
            'class' => [
                'type'    => 'textfield',
                'heading' => 'Extra class',
                'default' => '',
            ],
        ],
    ]);
});
