<?php
function button_shortcode($atts)
{
    ob_start();

    get_template_part(
        'base/template-parts/button/index',
        null,
        $atts
    );

    return ob_get_clean();
}
add_shortcode('button_shortcode', 'button_shortcode');
// button với thẻ a chuyển hướng
// echo do_shortcode("[button_shortcode class='custom-class' text='Ghé 24h' url='24h.com.vn' type='a']"); 
// button với support modal có id là modal-1
// echo do_shortcode("[button_shortcode class='custom-class' text='Xem thêm' url='24h.com.vn' type='button' data-modal-target='modal-1']");