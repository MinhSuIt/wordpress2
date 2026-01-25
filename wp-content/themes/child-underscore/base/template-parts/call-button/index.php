    <?php
    if (! defined('ABSPATH')) {
        exit; // Exit if accessed directly
    }
    ?>
    <?php
    $class = esc_attr($args['class'] ?? '');
    $phone = esc_attr($args['phone'] ?? '');
    ?>
    <a href="tel:+84<?php echo $phone; ?>" class="call-button<?php echo " " . $class; ?>">
        <i class="fa fa-phone"></i>
    </a>