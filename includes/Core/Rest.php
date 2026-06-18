<?php
/**
 * Core Class: Rest Api
 *
 * @package Themora
 */

namespace Themora\Inc\Core;

use Themora\Inc\Rest\SettingsController;
use Themora\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

class Rest {
	use Singleton;

	private function __construct() {
		add_action( 'rest_api_init', [ $this, 'register_routes' ] );
	}

	public function register_routes(): void {
		SettingsController::getInstance()->register_routes();
	}
}