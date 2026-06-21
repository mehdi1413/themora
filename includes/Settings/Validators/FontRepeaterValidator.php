<?php
/**
 * Field Validator: Font Repeater Field
 *
 * @package Themora
 */

namespace Themora\Inc\Settings\Validators;

use Themora\Inc\Settings\Contracts\ValidatorInterface;

defined( 'ABSPATH' ) || exit;

class FontRepeaterValidator implements ValidatorInterface {

	public function validate( $value, array $rules = [] ): array {
		if ( ! is_array( $value ) ) {
			return [];
		}

		$result = [];

		foreach ( $value as $family ) {
			$family_name = sanitize_text_field( $family['family'] ?? '' );

			if ( empty( $family_name ) ) {
				continue;
			}

			$item = [
				'family' => $family_name,
				'fonts'  => []
			];

			foreach ( $family['fonts'] ?? [] as $font ) {

				$file_id = absint(
					$font['file'] ?? 0
				);

				if ( ! $file_id ) {
					continue;
				}

				$item['fonts'][] = [
					'file'    => $file_id,
					'size'    => absint( $font['size'] ?? 16 ),
					'format'  => sanitize_key( $font['format'] ?? 'woff2' ),
					'weight'  => sanitize_key( $font['weight'] ?? '400' ),
					'display' => sanitize_key( $font['display'] ?? 'swap' )
				];
			}


			if ( empty( $item['fonts'] ) ) {
				continue;
			}

			$result[] = $item;
		}

		return $result;
	}
}