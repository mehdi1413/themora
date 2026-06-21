<?php
/**
 * Validator Factory Class
 *
 * @package Themora
 */

namespace Themora\Inc\Settings\Validators;

use Exception;
use Themora\Inc\Settings\Contracts\ValidatorInterface;

defined( 'ABSPATH' ) || exit;

class ValidatorFactory {

	/**
	 * @throws Exception
	 */
	public static function make( string $type ): ValidatorInterface {
		switch ( $type ) {
			case 'text':
				return new TextFieldValidator();
			case 'number':
				return new NumberFieldValidator();
			case 'boolean':
				return new BooleanFieldValidator();
			case 'select':
				return new SelectFieldValidator();
			case 'color':
				return new ColorPickerFieldValidator();
			case 'media':
				return new MediaFieldValidator();
			case 'multiselect':
				return new MultiselectValidator();
			case 'font-repeater':
				return new FontRepeaterValidator();
			default:
				throw new Exception( 'Validator not found' );
		}
	}
}