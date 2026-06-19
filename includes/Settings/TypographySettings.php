<?php
/**
 * Typography Setting Class
 *
 * @package Themora
 */

namespace Themora\Inc\Settings;

use Themora\Inc\Settings\Contracts\ValidatorInterface;
use Themora\Inc\Settings\Helpers\FieldSchema;
use Themora\Inc\Settings\Validators\ValidatorFactory;

defined( 'ABSPATH' ) || exit;

class TypographySettings implements ValidatorInterface {

	public function validate( $value, array $rules = [] ): array {
		$output = [];

		foreach ( $this->schema() as $section => $fields ) {
			foreach ( $fields as $key => $field ) {
				$validator                  = ValidatorFactory::make( $field['type'] );
				$output[ $section ][ $key ] = $validator->validate( $value[ $section ][ $key ] ?? null, $field );
			}
		}

		return $output;
	}

	protected function schema(): array {
		return [
			'size'  => [
				'xl6'  => FieldSchema::number( 0, 100 ),
				'xl5'  => FieldSchema::number( 0, 100 ),
				'xl4'  => FieldSchema::number( 0, 100 ),
				'xl3'  => FieldSchema::number( 0, 100 ),
				'xl'   => FieldSchema::number( 0, 100 ),
				'base' => FieldSchema::number( 0, 100 ),
				'sm'   => FieldSchema::number( 0, 100 ),
				'xs'   => FieldSchema::number( 0, 100 ),
			],
			'fonts' => [
				'primary'   => FieldSchema::text(),
				'secondary' => FieldSchema::text(),
			]
		];
	}
}