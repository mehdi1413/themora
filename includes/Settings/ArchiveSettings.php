<?php
/**
 * Archive Setting Class
 *
 * @package Themora
 */

namespace Themora\Inc\Settings;

use Themora\Inc\Settings\Contracts\SettingInterface;
use Themora\Inc\Settings\Validators\ValidatorFactory;

defined( 'ABSPATH' ) || exit;

class ArchiveSettings implements SettingInterface {

	public function validate( array $input ): array {
		$output = [];

		foreach ( $this->schema() as $key => $field ) {
			if ( ! isset( $field['type'] ) ) {
				continue;
			}
			$validator      = ValidatorFactory::make( $field['type'] );
			$output[ $key ] = $validator->validate( $input[ $key ] ?? null, $field );
		}

		return $output;
	}

	protected function schema(): array {
		return [
			'removePrefix' => [
				'type' => 'boolean'
			],
			'perPage'      => [
				'type' => 'number',
				'min'  => 2,
				'max'  => 24,
			]
		];
	}
}