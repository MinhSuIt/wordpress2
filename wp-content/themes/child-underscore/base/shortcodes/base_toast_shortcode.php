<?php
function base_toast_shortcode($atts)
{
    wp_enqueue_style(
        'toast',
        get_stylesheet_directory_uri() . '/base/template-parts/toast/style.css',
        array(), // dependency
        wp_get_theme()->get('Version'),
        'all' // media: all, screen, print
    );
    wp_enqueue_script(
        'toast',
        get_stylesheet_directory_uri() . '/base/template-parts/toast/js.js',
        array(),
        wp_get_theme()->get('Version'),
        array('strategy' => 'defer')
    );
    ob_start();

    get_template_part(
        'base/template-parts/toast/index',
        null,
        $atts
    );

    return ob_get_clean();
}
add_shortcode('base_toast_shortcode', 'base_toast_shortcode');
// echo do_shortcode("[base_toast_shortcode]"); 
// showToast('Cảnh báo!', 'warning')

// <div class="actions">
//     <button onclick="showToast('Thành công!', 'success')">Success</button>
//     <button onclick="showToast('Có lỗi xảy ra!', 'error')">Error</button>
//     <button onclick="showToast('Thông tin mới', 'info')">Info</button>
//     <button onclick="showToast('Cảnh báo!', 'warning')">Warning</button>
// </div>