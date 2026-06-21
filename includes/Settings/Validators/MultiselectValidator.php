<?php
/**
 * Field Validator: Multi Select Field
 *
 * @package Themora
 */

namespace Themora\Inc\Settings\Validators;

use Themora\Inc\Settings\Contracts\ValidatorInterface;

defined( 'ABSPATH' ) || exit;

class MultiselectValidator implements ValidatorInterface {
	public function validate( $value, array $rules = [] ) {
		if ( ! is_array( $value ) ) {
			return $rules['default'] ?? [];
		}

		$options = $rules['options'] ?? [];

		$allowed = array_map(
			function ( $item ) {
				return (string) $item;
			},
			$options
		);

		return array_values(
			array_filter( $value,
				function ( $item ) use ( $allowed ) {
					return in_array( $item, $allowed, true );
				}
			)
		);
	}
}