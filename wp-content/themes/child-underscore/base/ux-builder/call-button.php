<?php

add_action('ux_builder_setup', function () {

    add_ux_builder_shortcode('call_button_shortcode', array(
        'name'      => __('Call Button'),
        'category'  => __('Content'),
        'priority'  => 1,
        'thumbnail' => '',

        'options' => array(

            'phone' => array(
                'type'        => 'textfield',
                'heading'     => __('Phone Number'),
                'placeholder' => '0915452237',
                'default'     => '',
            ),

            'class' => array(
                'type'        => 'textfield',
                'heading'     => __('Custom CSS Class'),
                'placeholder' => 'custom-class',
                'default'     => '',
            ),

        ),

        'render' => function ($atts) {
            return do_shortcode('[call_button_shortcode phone="' . esc_attr($atts['phone']) . '" class="' . esc_attr($atts['class']) . '"]');
        },
    ));
});
