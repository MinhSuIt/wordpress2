<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://author-website.com
 * @since      1.0.0
 *
 * @package    Plugin_1
 * @subpackage Plugin_1/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plugin_1
 * @subpackage Plugin_1/admin
 * @author     Author Name <author-email@gmail.com>
 */
class Plugin_1_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_1_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_1_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/plugin-1-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_1_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_1_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/plugin-1-admin.js', array('jquery'), $this->version, false);
	}

	// custom
	public function my_plugin_add_admin_menu()
	{
		add_menu_page(
			'Plugin 1',
			'Plugin 1',
			'manage_options',
			'plugin-1-settings',
			'plugin_1_settings_page',
			'dashicons-admin-generic',
			100
		);

		add_submenu_page(
			'plugin-1-settings',       // Slug của menu cha (menu chính)
			'General Settings',        // Tiêu đề trang submenu
			'General Settings',        // Tên menu submenu
			'manage_options',          // Quyền truy cập
			'plugin-1-general-settings', // Slug cho submenu
			'plugin_1_general_settings_page' // Hàm hiển thị nội dung submenu
		);

		add_submenu_page(
			'plugin-1-settings',       // Slug của menu cha (menu chính)
			'Advanced Settings',       // Tiêu đề trang submenu
			'Advanced Settings',       // Tên menu submenu
			'manage_options',          // Quyền truy cập
			'plugin-1-advanced-settings', // Slug cho submenu
			'plugin_1_advanced_settings_page' // Hàm hiển thị nội dung submenu
		);
	}
	public function plugin_1_add_dashboard_widget()
	{
		wp_add_dashboard_widget(
			'plugin_1_dashboard_widget',
			'Plugin 1 Widget',
			'plugin_1_dashboard_widget_content'
		);
	}
}
