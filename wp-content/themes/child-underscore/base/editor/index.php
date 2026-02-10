<?php
/**
 * Thêm nút shortcode box_download vào TinyMCE
 * một số plugin/theme đã hỗ trợ sẵn editor: table of content, flatsome cho insert shortcodes 
 * code này hiện chưa chạy, qua gtasan/modminecraftpe.org lấy thêm shortcode bổ sung
 */
add_action('admin_init', function () {

    // Kiểm tra quyền
    if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
        return;
    }

    // Kiểm tra Classic Editor
    if (get_user_option('rich_editing') !== 'true') {
        return;
    }

    add_filter('mce_external_plugins', 'box_download_tinymce_plugin');
    add_filter('mce_buttons', 'box_download_tinymce_button');
});

/**
 * Load JS cho TinyMCE
 */
function box_download_tinymce_plugin($plugins) {
    $plugins['box_download'] = get_stylesheet_directory_uri() . '/assets/box-download-tinymce.js';
    return $plugins;
}

/**
 * Thêm nút vào toolbar
 */
function box_download_tinymce_button($buttons) {
    array_push($buttons, 'box_download');
    return $buttons;
}
// End Thêm nút shortcode box_download vào TinyMCE