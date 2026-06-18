<?php
/**
 * Field Validator: Color Picker Field
 *
 * @package Themora
 */

namespace Themora\Inc\Settings\Validators;

use Themora\Inc\Settings\Contracts\ValidatorInterface;

defined( 'ABSPATH' ) || exit;

class ColorPickerFieldValidator implements ValidatorInterface {

	public function validate( $value, array $rules = [] ): string {
		$value = sanitize_text_field( $value );

		if ( ! preg_match( '/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value ) ) {
			return '#ffffff';
		}

		return $value;
	}
}