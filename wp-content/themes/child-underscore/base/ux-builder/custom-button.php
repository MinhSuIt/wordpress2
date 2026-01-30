<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<?php
add_ux_builder_shortcode('custom_button_shortcode', array(
    'name'      => __('Custom Button', 'ux-builder'), // tên widget trong UX Builder
    'category'  => __('DMS Content'), // layout/content/media/interactive/shop/form/ux... hoặc bất cứ tên gì để gom widget trong UX Builder vào cùng danh mục ví dụ DMS Layout
    // 'template'  => custom_flatsome_ux_builder_template('section.html'), // cách hiển thị trong UX Builder
    // 'thumbnail' => custom_flatsome_ux_builder_thumbnail('section'), // hình đại diện trong UX Builder
    'info'      => '{{ label }}',
    'priority'  => -1, // thứ tự sắp xếp trong danh mục, nhỏ trước lớn sau
    // ---------------Các thuộc tính cho phép nested-------------
    'type'      => 'single', // container (kéo thả các widget khác vào)/single (ko có content dùng dạng [shortcode attr="x"])
    'wrap'      => false,
    'require'   => array(),  // điều kiện hiển thị & cho phép dùng element trong UX Builder, ít dùng
    // ---------------Các thuộc tính cho phép nested-------------
    'options' => array(
        // TEXT
        'text' => array(
            'type'        => 'textfield',
            'heading'     => __('Text'),
            'default'     => 'Click me',
            'placeholder' => 'Enter button text...',
        ),

        // URL
        'url' => array(
            'type'        => 'textfield',
            'heading'     => __('URL'),
            'default'     => '#',
            'placeholder' => 'https://example.com',
        ),

        // TYPE: button | a
        'type' => array(
            'type'    => 'select',
            'heading' => __('HTML Tag'),
            'default' => 'button',
            'options' => array(
                'button' => 'Button (<button>)',
                'a'      => 'Link (<a>)',
            ),
        ),

        // CLASS
        'class' => array(
            'type'        => 'textfield',
            'heading'     => __('Extra Class'),
            'placeholder' => 'custom-class another-class',
        ),
        'advanced_options' => require(get_template_directory() . '/inc/builder/shortcodes/commons/advanced.php'),
    ),
));
