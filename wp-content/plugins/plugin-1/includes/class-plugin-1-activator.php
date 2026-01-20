<?php

/**
 * Fired during plugin activation
 *
 * @link       https://author-website.com
 * @since      1.0.0
 *
 * @package    Plugin_1
 * @subpackage Plugin_1/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Plugin_1
 * @subpackage Plugin_1/includes
 * @author     Author Name <author-email@gmail.com>
 */
class Plugin_1_Activator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate()
	{
		global $wpdb;

		// Tên bảng bạn muốn tạo
		$table_name = $wpdb->prefix . 'plugin_table';  // Bạn có thể thay đổi tên bảng ở đây

		// Câu lệnh SQL để tạo bảng
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
            id INT(11) NOT NULL AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            description TEXT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        ) $charset_collate;";

		// Kiểm tra nếu bảng đã tồn tại hay chưa và tạo bảng
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}
}
