<?php
/**
 * Core Class: Register Admin Menu
 *
 * @package Themora
 */

namespace Themora\Inc\Core;

use Themora\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

class Admin {
	use Singleton;

	private function __construct() {
		add_action( 'admin_menu', [ $this, 'register_admin_menu' ] );
	}

	/**
	 * Register Admin Menu Page
	 *
	 * @return void
	 */
	public function register_admin_menu(): void {
		add_menu_page(
			'themora options',
			'themora options',
			'manage_options',
			'themora-options',
			[ $this, 'render_admin_menu_page' ],
			'dashicons-slides',
			100,
		);
	}

	/**
	 * Admin Menu Callback Render
	 *
	 * @return void
	 */
	public function render_admin_menu_page(): void {
		include plugin_dir_path( THM_PLUGIN_PATH ) . 'templates/index.php';
	}
}