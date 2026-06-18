<?php
/**
 * Field Validator: Select Field
 *
 * @package Themora
 */

namespace Themora\Inc\Settings\Validators;

use Themora\Inc\Settings\Contracts\ValidatorInterface;

defined( 'ABSPATH' ) || exit;

class SelectFieldValidator implements ValidatorInterface {

	public function validate( $value, array $rules = [] ) {
		$value = sanitize_text_field( $value );

		if ( isset( $rules['options'] ) && ! in_array( $value, $rules['options'], true ) ) {
			return $rules['default'] ?? '';
		}

		return $value;
	}
}