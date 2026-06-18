<?php
/**
 * Setting Manager Class
 *
 * @package Themora
 */

namespace Themora\Inc\Settings;

use Themora\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

class SettingsManager {
	use Singleton;

	private SettingsRepository $repository;
	private array $validators = [];

	private function __construct() {
		$this->repository = SettingsRepository::getInstance();

		$this->validators = [
			'general' => new GeneralSettings(),
			'archive' => new ArchiveSettings(),
		];
	}


	public function get(): array {
		return $this->repository->get_options();
	}


	public function validate( array $input ): array {
		$output = [];
		foreach ( $this->validators as $key => $validator ) {
			if ( ! isset( $input[ $key ] ) ) {
				continue;
			}

			$output[ $key ] = $validator->validate( $input[ $key ] );
		}

		return $output;
	}

	public function save( array $input ): array {
		$current = $this->repository->get_options();
		$validated = $this->validate( $input );
		$final = array_replace_recursive( $current, $validated );
		$saved = $this->repository->save_options( $final );

		return [
			'saved' => $saved,
			'data'  => $final
		];
	}
}