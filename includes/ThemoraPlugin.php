<?php
/**
 * Class: Plugin Core & Bootstrap
 *
 * @package Themora
 */

namespace Themora\Inc;

use Themora\Inc\Core\Admin;
use Themora\Inc\Core\Assets;
use Themora\Inc\Core\Rest;
use Themora\Inc\Settings\SettingsManager;
use Themora\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

final class ThemoraPlugin {
	use Singleton;

	private function __construct() {
		$this->init_hook();
	}

	private function init_hook(): void {
		add_action( 'plugins_loaded', [ $this, 'load' ] );
	}

	/**
	 * Load Plugin Features
	 *
	 * @return void
	 */
	public function load(): void {
		$this->test_settings();
		$this->load_admin_menu();
		$this->load_assets();
		$this->load_rest();
	}

	private function load_admin_menu(): void {
		Admin::getInstance();
	}

	/**
	 * Load Plugin Assets
	 * @return void
	 */
	private function load_assets(): void {
		Assets::getInstance();
	}

	private function load_rest(): void {
		Rest::getInstance();
	}

	private function test_settings(): void {
		$result =
			SettingsManager::getInstance()->save( [
				'general' => [
					'title'     => 'mehdi fani 2',
					'showTitle' => true,
					'selectOne' => 'ASC'
				],
				'archive' => [
					'removePrefix' => true,
					'perPage'      => 20
				]
			] );
//		var_dump( $result );
//		var_dump( SettingsManager::getInstance()->get() );
	}
}