<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://author-website.com
 * @since             1.0.0
 * @package           Plugin_1
 *
 * @wordpress-plugin
 * Plugin Name:       Plugin 1
 * Plugin URI:        https://website.com
 * Description:       Plugin 1
 * Version:           1.0.0
 * Author:            Author Name
 * Author URI:        https://author-website.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       plugin-1
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('PLUGIN_1_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-1-activator.php
 */
function activate_plugin_1()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-plugin-1-activator.php';

	Plugin_1_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-1-deactivator.php
 */
function deactivate_plugin_1()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-plugin-1-deactivator.php';
	Plugin_1_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_plugin_1');
register_deactivation_hook(__FILE__, 'deactivate_plugin_1');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-plugin-1.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plugin_1()
{

	$plugin = new Plugin_1();

	// custom cho giao diện của cả admin và user
	// add_action('save_post', 'on_save_post');

	$plugin->run();
}

// load widget
require_once plugin_dir_path( __FILE__ ) . 'custom-widget/simple-text-widget.php';
// Register widget
function plugin_1_register_widgets() {
    register_widget( 'Simple_Text_Widget' );
}
add_action( 'widgets_init', 'plugin_1_register_widgets' );


run_plugin_1();

// function on_save_post($post_id)
// {
// 	// khi create/update/delete trong wp_posts hoặc woo_product thì xóa cache cloudflare và redis cache
// 	// yêu cầu user cài đặt plugin redis cache
// 	// khi thay đổi mật khẩu admin thì báo lại với mình
// 	error_log('on_save_post khi tọa mới hoặc update wp_posts clear cache cloudflare');


// 	// Thông tin API của Cloudflare
// 	$zone_id = 'your-zone-id'; // Thay 'your-zone-id' bằng Zone ID của bạn
// 	$api_token = 'your-api-token'; // Thay 'your-api-token' bằng API Token của bạn

// 	// URL của Cloudflare API để xóa cache
// 	$api_url = "https://api.cloudflare.com/client/v4/zones/{$zone_id}/purge_cache";

// 	// Dữ liệu yêu cầu (clear all cache)
// 	$data = json_encode([
// 		"purge_everything" => true
// 	]);

// 	// Khởi tạo cURL
// 	$ch = curl_init();

// 	// Thiết lập cURL
// 	curl_setopt($ch, CURLOPT_URL, $api_url);
// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); // Phương thức DELETE
// 	curl_setopt($ch, CURLOPT_HTTPHEADER, [
// 		"Authorization: Bearer {$api_token}",
// 		"Content-Type: application/json"
// 	]);
// 	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// 	// Thực hiện yêu cầu
// 	$response = curl_exec($ch);

// 	// Kiểm tra lỗi
// 	if (curl_errno($ch)) {
// 		echo 'Error:' . curl_error($ch);
// 	} else {
// 		// Xử lý phản hồi từ Cloudflare API
// 		$response_data = json_decode($response, true);
// 		if (isset($response_data['success']) && $response_data['success'] === true) {
// 			echo "Cache cleared successfully!";
// 		} else {
// 			echo "Error clearing cache: " . json_encode($response_data);
// 		}
// 	}

// 	// Đóng cURL
// 	curl_close($ch);


// 	// // Kiểm tra nếu bài viết là mới
// 	// if (wp_is_post_revision($post_id)) {
// 	// 	return;
// 	// }

// 	// // Nếu bài viết được tạo mới
// 	// if ($post_id === 0) {
// 	// 	// Code xử lý khi bài viết mới được tạo
// 	// 	// Thực hiện các hành động cần thiết
// 	// 	error_log('A new post has been created!');
// 	// }
// }



