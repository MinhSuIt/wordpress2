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
function gallery_lightbox_shortcode($atts)
{
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
add_shortcode('gallery_lightbox_shortcode', 'gallery_lightbox_shortcode');
// <?php echo do_shortcode("[gallery_lightbox_shortcode class='custom-class']"); 
?>
