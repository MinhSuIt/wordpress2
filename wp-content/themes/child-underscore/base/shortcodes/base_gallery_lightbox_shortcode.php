<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<?php
function wpImage($url, $size = '600x408')
{
    return preg_replace('/(\d+)\.(jpg|jpeg|png|webp)$/i', '$1-' . $size . '.$2', $url);
}
function base_gallery_lightbox_shortcode($atts)
{
    wp_enqueue_style(
        'gallery-lightbox',
        get_stylesheet_directory_uri() . '/base/template-parts/gallery-lightbox/style.css',
        array(), // dependency
        wp_get_theme()->get('Version'),
        'all' // media: all, screen, print
    );
    wp_enqueue_script(
        'gallery-lightbox',
        get_stylesheet_directory_uri() . '/base/template-parts/gallery-lightbox/js.js',
        array(),        // dependency, ví dụ: array('jquery')
        wp_get_theme()->get('Version'),
        array('strategy' => 'defer') // strategy: 'defer' hoặc 'async'
    );

    $params = [
        'class'          => $atts['class'] ?? '', // để custom css
    ];
    unset($atts['class']);
    $i = 0;
    foreach ($atts as $value) {
        // là url trong media library với dạng abc.xxx, ko bao gồm kích thước ảnh cụ thể như 100x100...
        // http://wordpress2.test/wp-content/uploads/2025/01/3.jpg 
        // => http://wordpress2.test/wp-content/uploads/2025/01/3-600x408.jpg
        $params['list'][$i]['origin'] = $value;
        $params['list'][$i]['thumbnail'] = wpImage($value, '600x408');
        $params['list'][$i]['lightbox'] = wpImage($value, '1536x1044');
        $i++;
    }
    ob_start();
    get_template_part(
        'base/template-parts/gallery-lightbox/index',
        null,
        $params
    );
    return ob_get_clean();
}
add_shortcode('base_gallery_lightbox_shortcode', 'base_gallery_lightbox_shortcode');
// echo do_shortcode("[base_gallery_lightbox_shortcode class='custom-class' 
// a='http://wordpress2.test/wp-content/uploads/2025/01/3.jpg' 
// b='http://wordpress2.test/wp-content/uploads/2026/01/1.jpg' 
// c='http://wordpress2.test/wp-content/uploads/2026/01/2.jpg']");
?>
