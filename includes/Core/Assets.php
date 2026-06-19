<?php
/**
 * Core Class: Register Assets
 *
 * @package Themora
 */

namespace Themora\Inc\Core;

use Themora\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

class Assets {
	use Singleton;

	protected function __construct() {
		add_action( 'admin_enqueue_scripts', [ $this, 'register_scripts' ], 99 );
		add_filter( 'script_loader_tag', [ $this, 'add_force_module_type_attributes' ], 10, 2 );
	}

	/**
	 * Register Plugin Scripts
	 *
	 * @param $hook
	 *
	 * @return void
	 */
	public function register_scripts( $hook ): void {
		if ( $hook !== 'toplevel_page_themora-options' ) {
			return;
		}

		wp_register_script(
			'thm-vue-js',
			plugin_dir_url( THM_PLUGIN_PATH ) . 'dist/assets/index.js',
			[],
			null,
			true
		);
		wp_register_style(
			'thm-vue-css',
			plugin_dir_url( THM_PLUGIN_PATH ) . 'dist/assets/index.css',
			[]
		);

		wp_enqueue_media();
		wp_enqueue_style( 'thm-vue-css' );

		wp_enqueue_script( 'thm-vue-js' );
		wp_localize_script(
			'thm-vue-js',
			'themoraData',
			[
				'apiUrl' => rest_url( 'themora/v1/' ),
				'nonce'   => wp_create_nonce( 'wp_rest' )
			]
		);
	}

	public function add_force_module_type_attributes( $tag, $handle ) {
		if ( $handle === 'thm-vue-js' ) {
			$script_url = plugin_dir_url( THM_PLUGIN_PATH ) . 'dist/assets/index.js';

			return '<script type="module" defer src="' . esc_url( $script_url ) . '" id="' . $handle . '-js"></script>';
		}

		return $tag;
	}
}