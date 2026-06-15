<?php

defined( 'ABSPATH' ) || exit;


add_action( 'admin_menu', 'thm_admin_page' );

function thm_admin_page(): void {
	add_menu_page(
		'theme options',
		'theme options',
		'manage_options',
		'theme-options',
		'thm_render_page',
		'dashicons-slides',
		100,
	);
}


function thm_render_page(): void {
	include plugin_dir_path( THM_PLUGIN_PATH ) . 'templates/index.php';
}

add_action( 'admin_enqueue_scripts', 'wp_ato_scripts' );

function wp_ato_scripts( $hook ): void {
	if (
		$hook !== 'toplevel_page_theme-options' ||
		wp_script_is( 'thm-vue-js', 'enqueued' )
	) {
		return;
	}

	wp_enqueue_script(
		'thm-vue-js',
		plugin_dir_url( THM_PLUGIN_PATH ) . 'dist/assets/index.js',
		[],
		null,
		true
	);

	wp_enqueue_style(
		'thm-vue-css',
		plugin_dir_url( THM_PLUGIN_PATH ) . 'dist/assets/index.css',
	);

}


add_filter( 'script_loader_tag', 'wp_ato_force_module_type_attributes', 10, 2 );

function wp_ato_force_module_type_attributes( $tag, $handle ) {

	if ( $handle === 'thm-vue-js' ) {
		$script_url = plugin_dir_url( THM_PLUGIN_PATH ) . 'dist/assets/index.js';

		return '<script type="module" defer src="' . esc_url( $script_url ) . '" id="'.$handle.'-js"></script>';
	}

	return $tag;
}