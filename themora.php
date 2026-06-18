<?php
/*
 * Plugin Name:       Themora
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Best wordpress theme settings plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            Mehdi fani
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       themora-options
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'THM_PLUGIN_PATH' ) ) {
	define( 'THM_PLUGIN_PATH', __FILE__ );
}

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}


require_once plugin_dir_path( THM_PLUGIN_PATH ) . 'includes/init.php';
