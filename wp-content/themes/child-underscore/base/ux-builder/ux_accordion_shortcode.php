<?php
function ux_accordion_shortcode()
{
    add_ux_builder_shortcode('accordion_shortcode', array(
        'name'     => __('Custom Accordion'),
        'category' => __('Content'),
        'priority' => 1,

        'options' => array(

            'class' => array(
                'type'        => 'textfield',
                'heading'     => __('Custom CSS Class'),
                'placeholder' => 'custom-class',
                'default'     => '',
            ),

            'folder' => array(
                'type'        => 'textfield',
                'heading'     => __('Template Folder'),
                'description' => __('Path từ theme hiện tại'),
                'default'     => 'base/template-parts/accordion/',
            ),

            // Accordion item 1
            'title-1' => array(
                'type'    => 'textfield',
                'heading' => __('Title 1'),
                'default' => '',
            ),
            'template-1' => array(
                'type'        => 'textfield',
                'heading'     => __('Template 1'),
                'placeholder' => 'template-1',
                'default'     => '',
            ),

            // Accordion item 2
            'title-2' => array(
                'type'    => 'textfield',
                'heading' => __('Title 2'),
                'default' => '',
            ),
            'template-2' => array(
                'type'        => 'textfield',
                'heading'     => __('Template 2'),
                'placeholder' => 'template-2',
                'default'     => '',
            ),

            // Accordion item 3
            'title-3' => array(
                'type'    => 'textfield',
                'heading' => __('Title 3'),
                'default' => '',
            ),
            'template-3' => array(
                'type'        => 'textfield',
                'heading'     => __('Template 3'),
                'placeholder' => 'template-3',
                'default'     => '',
            ),
        ),

        'render' => function ($atts) {

            $shortcode = '[accordion_shortcode';

            foreach ($atts as $key => $value) {
                if ($value !== '') {
                    $shortcode .= ' ' . $key . '="' . esc_attr($value) . '"';
                }
            }

            $shortcode .= ']';

            return do_shortcode($shortcode);
        },
    ));
}
