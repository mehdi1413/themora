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

		$formats = $rules['formats'] ?? [ 'hex' ];
		if ( in_array( 'hex', $formats, true ) && $this->isHex( $value ) ) {
			return strtoupper( $value );
		}

		if ( in_array( 'rgba', $formats, true ) && $this->isRgba( $value ) ) {
			return $value;
		}

		return '#ffffff';
	}


	/**
	 * Check Color format is hex format or not
	 *
	 * @param string $value
	 *
	 * @return bool
	 */
	private function isHex( string $value ): bool {
		return (bool) preg_match(
			'/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/',
			$value
		);
	}

	/**
	 * Check Color format is RGBA format or not
	 * @param string $value
	 *
	 * @return bool
	 */
	private function isRgba( string $value ): bool {
		if ( ! preg_match(
			'/^rgba\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(0|1|0?\.\d+)\s*\)$/',
			$value,
			$m
		)
		) {
			return false;
		}


		return
			$m[1] <= 255 &&
			$m[2] <= 255 &&
			$m[3] <= 255;
	}

}