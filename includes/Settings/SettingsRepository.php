<?php
/**
 * Setting Repository
 *
 * @package Themora
 */

namespace Themora\Inc\Settings;

use Themora\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

class SettingsRepository {
	use Singleton;

	private string $option_name = 'themora_options';

	public function get_options(): array {
		$options = get_option( $this->option_name, [] );

		return wp_parse_args( $options, Defaults::get() );
	}

	public function save_options( array $options ): bool {
		return update_option( $this->option_name, $options );
	}
}