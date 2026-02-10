<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<?php
function ux_gallery_lightbox_shortcode()
{
    add_ux_builder_shortcode('gallery_lightbox_shortcode', array(
        'name'     => __('Gallery Lightbox'),
        'category' => __('Content'),
        'priority' => 1,

        'options' => array(

            'class' => array(
                'type'        => 'textfield',
                'heading'     => __('Custom CSS Class'),
                'placeholder' => 'custom-class',
                'default'     => '',
            ),

            'images' => array(
                'type'    => 'group',
                'heading' => __('Images'),
                'options' => array(

                    'img-1' => array(
                        'type'    => 'image',
                        'heading' => __('Image 1'),
                    ),

                    'img-2' => array(
                        'type'    => 'image',
                        'heading' => __('Image 2'),
                    ),

                    'img-3' => array(
                        'type'    => 'image',
                        'heading' => __('Image 3'),
                    ),

                    'img-4' => array(
                        'type'    => 'image',
                        'heading' => __('Image 4'),
                    ),

                    'img-5' => array(
                        'type'    => 'image',
                        'heading' => __('Image 5'),
                    ),

                    'img-6' => array(
                        'type'    => 'image',
                        'heading' => __('Image 6'),
                    ),
                ),
            ),
        ),

        'render' => function ($atts) {

            $shortcode = '[gallery_lightbox_shortcode';

            if (!empty($atts['class'])) {
                $shortcode .= ' class="' . esc_attr($atts['class']) . '"';
            }

            if (!empty($atts['images'])) {
                $i = 1;
                foreach ($atts['images'] as $item) {
                    if (!empty($item['image'])) {
                        $image_url = wp_get_attachment_url($item['image']);
                        if ($image_url) {
                            $shortcode .= ' img-' . $i . '="' . esc_url($image_url) . '"';
                            $i++;
                        }
                    }
                }
            }

            $shortcode .= ']';

            return do_shortcode($shortcode);
        },
    ));
}
