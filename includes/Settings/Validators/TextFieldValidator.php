<?php
/**
 * Field Validator: Text Field
 *
 * @package Themora
 */

namespace Themora\Inc\Settings\Validators;

use Themora\Inc\Settings\Contracts\ValidatorInterface;

defined( 'ABSPATH' ) || exit;

class TextFieldValidator implements ValidatorInterface {

	public function validate( $value, array $rules = [] ): string {
		$value = is_string( $value ) ? trim( $value ) : '';

		return sanitize_text_field( $value );
	}
}