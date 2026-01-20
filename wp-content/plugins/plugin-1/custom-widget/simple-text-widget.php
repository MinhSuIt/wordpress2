<?php
/*
Plugin Name: Simple Text Widget
Description: Ví dụ widget đơn giản
Version: 1.0
*/

class Simple_Text_Widget extends WP_Widget
{

    // Khởi tạo widget
    function __construct()
    {
        parent::__construct(
            'simple_text_widget',
            __('Simple Text Widget', 'textdomain'),
            ['description' => __('Widget hiển thị text', 'textdomain')]
        );
    }

    // Hiển thị widget ngoài frontend
    public function widget($args, $instance)
    {
        // Tạo HTML wrapper tùy chỉnh
        echo '<div class="simple-text-widget">';

        // Tiêu đề widget (nếu có)
        if (!empty($instance['title'])) {
            echo '<h2 class="widgettitle">' . esc_html($instance['title']) . '</h2>';
        }

        // Nội dung widget (nếu có)
        if (!empty($instance['content'])) {
            echo '<p>' . esc_html($instance['content']) . '</p>';
        }

        // Đóng wrapper
        echo '</div>';
    }

    // Form cấu hình trong Admin
    public function form($instance)
    {
        $title   = $instance['title'] ?? '';
        $content = $instance['content'] ?? '';
?>
        <p>
            <label>Tiêu đề:</label>
            <input class="widefat"
                name="<?= $this->get_field_name('title'); ?>"
                type="text"
                value="<?= esc_attr($title); ?>">
        </p>
        <p>
            <label>Nội dung:</label>
            <textarea class="widefat"
                name="<?= $this->get_field_name('content'); ?>">
                <?= esc_textarea($content); ?>
            </textarea>
        </p>
<?php
    }

    // Lưu dữ liệu
    public function update($new_instance, $old_instance)
    {
        return [
            'title'   => sanitize_text_field($new_instance['title']),
            'content' => sanitize_textarea_field($new_instance['content'])
        ];
    }
}

// Đăng ký widget
function register_simple_text_widget()
{
    register_widget('Simple_Text_Widget');
}
add_action('widgets_init', 'register_simple_text_widget');

// Widget có CSS & JS riêng
function simple_text_widget_assets()
{
    wp_enqueue_style(
        'simple-widget-css',
        plugin_dir_url(dirname(__FILE__, 1)) . 'public/css/simple-text-widget.css'
    );
}
add_action('wp_enqueue_scripts', 'simple_text_widget_assets');
