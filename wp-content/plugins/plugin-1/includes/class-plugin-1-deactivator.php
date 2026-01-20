<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://author-website.com
 * @since      1.0.0
 *
 * @package    Plugin_1
 * @subpackage Plugin_1/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Plugin_1
 * @subpackage Plugin_1/includes
 * @author     Author Name <author-email@gmail.com>
 */
class Plugin_1_Deactivator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate()
	{
		global $wpdb;

		// Tên bảng cần xóa
		$table_name = $wpdb->prefix . 'plugin_table';  // Bạn có thể thay đổi tên bảng ở đây

		// Câu lệnh SQL để xóa bảng
		$sql = "DROP TABLE IF EXISTS $table_name";

		// Thực thi câu lệnh SQL
		$wpdb->query($sql);
	}
}
