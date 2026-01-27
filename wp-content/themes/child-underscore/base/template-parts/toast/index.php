<!-- <div class="actions">
    <button onclick="showToast('Thành công!', 'success')">Success</button>
    <button onclick="showToast('Có lỗi xảy ra!', 'error')">Error</button>
    <button onclick="showToast('Thông tin mới', 'info')">Info</button>
    <button onclick="showToast('Cảnh báo!', 'warning')">Warning</button>
</div> -->

<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<?php
$class = esc_attr($args['class'] ?? '');
?>
<div class="toast-container<?php if ($class) echo ' ' . $class; ?>" id="toastContainer"></div>