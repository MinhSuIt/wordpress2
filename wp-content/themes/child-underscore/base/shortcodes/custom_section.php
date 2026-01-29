<?php
function custom_section($atts, $content = null)
{
    // wp_enqueue_style('my-css', get_stylesheet_directory_uri() . '/base/template-parts/my_shortcode/style.css');
    // wp_enqueue_script('my-js', get_stylesheet_directory_uri() . '/base/template-parts/my_shortcode/js.js', [], '1.0', ['strategy' => 'defer']);
    
    // Extract attributes với default values
    extract(shortcode_atts(array(
        'label'   => '',
        'dark'    => 'false',
        'sticky'  => '',
        'padding' => '30px',
        'height'  => '',
        'class'   => '',
    ), $atts));

    error_log('Label: ' . $label);
    error_log('Dark: ' . $dark);
    error_log('Padding: ' . $padding);
    ob_start(); ?>
    <div class="my-box">
        <?php echo do_shortcode($content); ?>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('custom_section', 'custom_section');
