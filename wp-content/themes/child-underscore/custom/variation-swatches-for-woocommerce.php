<?php
// Ngăn truy cập trực tiếp
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
// Custom cho plugin: Variation Swatches for WooCommerce
add_filter(
    'woo_variation_swatches_variable_item_css_class',
    function ($classes, $data, $type) {
        error_log($data['attribute_key']);
        if ($data['attribute_key'] === 'pa_color') {
            $classes[] = 'is-color-swatch';
        }

        return $classes;
    },
    10,
    3
);

add_filter(
    'woo_variation_swatches_global_variable_item_tooltip_text',
    function ($tooltip, $data) {

        if (!empty($data['variation_image_id'])) {
            return $tooltip . ' – Click để xem ảnh';
        }

        return $tooltip;
    },
    10,
    2
);
add_filter(
    'woo_variation_swatches_button_attribute_template',
    function ($template, $data) {

        return '<span class="11111 variable-item-span variable-item-span-button">
										%s <small class="badge">HOT</small>
									</span>';
    },
    10,
    2
);
add_filter(
    'woo_variation_swatches_single_product_wrapper_attributes',
    function ($attrs, $product) {

        if (!isset($attrs['class'])) {
            $attrs['class'] = '';
        }

        $attrs['class'] .= ' my-custom-wrapper';

        return $attrs;
    },
    10,
    2
);
add_filter(
    'woo_variation_swatches_variable_item_custom_attributes',
    function ($attrs, $data) {

        $attrs['data-label'] = $data['option_name'];
        $attrs['data-attr']  = $data['attribute_key'];
        return $attrs;
    },
    10,
    2
);
