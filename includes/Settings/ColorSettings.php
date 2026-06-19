<?php
/**
 * Colors Setting Class
 *
 * @package Themora
 */

namespace Themora\Inc\Settings;

use Themora\Inc\Settings\Contracts\ValidatorInterface;
use Themora\Inc\Settings\Validators\ValidatorFactory;

defined( 'ABSPATH' ) || exit;

class ColorSettings implements ValidatorInterface {

	public function validate( $value, array $rules = [] ): array {
		$output = [];

		foreach ( $this->schema() as $section => $fields ) {
			foreach ( $fields as $key => $field ) {
				$validator = ValidatorFactory::make( $field['type'] );

				$output[ $section ][ $key ] = $validator->validate( $value[ $section ][ $key ] ?? null, $field );
			}
		}

		return $output;
	}

	protected function schema(): array {
		return [
			'primary' => [
				'main'      => $this->color(),
				'secondary' => $this->color(),
				'dark'      => $this->color(),
				'grey'      => $this->color(),
				'white'     => $this->color(),
				'green'     => $this->color(),
				'blue'      => $this->color(),
			],

			'secondary' => [
				'success' => $this->color(),
				'info'    => $this->color(),
			]
		];
	}

	private function color( array $extra = [] ): array {
		return array_merge(
			[
				'type'    => 'color',
				'formats' => [
					'hex',
					'rgba'
				]
			],
			$extra
		);
	}
}