<?php

// dùng khi cần extends các shortcode lẫn nhau để tái sử dụng
class BaseShortcodeClass
{

    public static function register()
    {
        add_shortcode(
            'base_shortcode_class',
            [self::class, 'render']
        );
    }

    public static function render($atts)
    {
        // toàn bộ code trong function cũ
        return 'Hello shortcode class';
    }
}
BaseShortcodeClass::register();