<?php
/**
 * Field Validator: Number Field
 *
 * @package Themora
 */

namespace Themora\Inc\Settings\Validators;

use Themora\Inc\Settings\Contracts\ValidatorInterface;

defined( 'ABSPATH' ) || exit;

class NumberFieldValidator implements ValidatorInterface {

	public function validate( $value, array $rules = [] ): int {
		$value = absint( $value );

		if ( isset( $rules['min'] ) ) {
			$value = max( $rules['min'], $value );
		}

		if ( isset( $rules['max'] ) ) {
			$value = min( $rules['max'], $value );
		}

		return (int) $value;
	}
}