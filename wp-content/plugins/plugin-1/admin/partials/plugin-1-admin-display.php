<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://author-website.com
 * @since      1.0.0
 *
 * @package    Plugin_1
 * @subpackage Plugin_1/admin/partials
 */



// Nội dung của widget
function plugin_1_dashboard_widget_content() {
    echo '<p>Here is the content of my custom widget.</p>';
}

function plugin_1_settings_page()
{
    echo '<h1>Settings for My Plugin</h1>';
    echo '<p>Here you can configure your plugin settings.</p>';
}
function plugin_1_general_settings_page()
{
    echo '<h1>plugin_1_general_settings_page</h1>';
}

function plugin_1_advanced_settings_page()
{
    echo '<h1>plugin_1_advanced_settings_page</h1>';
}
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->