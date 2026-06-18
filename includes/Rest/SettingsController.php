<?php
/**
 * Rest Controller Class
 *
 * @package Themora
 */

namespace Themora\Inc\Rest;

use Themora\Inc\Settings\SettingsManager;
use Themora\Inc\Traits\Singleton;
use WP_REST_Request;
use WP_REST_Response;

defined( 'ABSPATH' ) || exit;

class SettingsController {
	use Singleton;

	private SettingsManager $manager;

	private function __construct() {
		$this->manager = SettingsManager::getInstance();
	}

	public function register_routes(): void {
		register_rest_route(
			'themora/v1',
			'/settings',
			[
				[
					'methods'             => 'GET',
					'callback'            => [ $this, 'get_settings' ],
					'permission_callback' => [ $this, 'permission' ]
				],
				[
					'methods'             => 'POST',
					'callback'            => [ $this, 'save_settings' ],
					'permission_callback' => [ $this, 'permission' ]
				]
			]
		);
	}

	public function permission(): bool {
//		return current_user_can( 'manage_options' );
		return true;
	}

	public function get_settings(): WP_REST_Response {
		return new WP_REST_Response(
			[
				'success' => true,
				'data'    => $this->manager->get()
			]
		);
	}

	public function save_settings( WP_REST_Request $request ): WP_REST_Response {
		$params = $request->get_json_params();
		$result = $this->manager->save( $params );

		return new WP_REST_Response(
			[
				'success' => true,
				'data'    => $result
			]
		);
	}
}