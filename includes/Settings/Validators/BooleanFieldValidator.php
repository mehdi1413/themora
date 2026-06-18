<?php
/**
 * Field Validator: Boolean Field
 *
 * @package Themora
 */

namespace Themora\Inc\Settings\Validators;

use Themora\Inc\Settings\Contracts\ValidatorInterface;

defined( 'ABSPATH' ) || exit;

class BooleanFieldValidator implements ValidatorInterface {

	public function validate( $value, array $rules = [] ) {
		return filter_var( $value, FILTER_VALIDATE_BOOLEAN );
	}
}