<?php
/**
 * Schema Field Generator Helper Class
 *
 * @package Themora
 */

namespace Themora\Inc\Settings\Helpers;

defined( 'ABSPATH' ) || exit;

class FieldSchema {

	/**
	 * Generate & Handle Number Input Field Schema
	 *
	 * @param int $min
	 * @param int $max
	 * @param array $extra
	 *
	 * @return array
	 */
	public static function number( int $min = 0, int $max = 999, array $extra = [] ): array {
		return array_merge(
			[
				'type' => 'number',
				'min'  => $min,
				'max'  => $max,
			],
			$extra
		);
	}


	/**
	 * Generate & Handle Text Input Field Schema
	 *
	 * @param array $extra
	 *
	 * @return array
	 */
	public static function text( array $extra = [] ): array {
		return array_merge(
			[
				'type' => 'text'
			],
			$extra
		);
	}

	/**
	 * Generate & Handle Color Field Schema
	 *
	 * @param array $extra
	 *
	 * @return array
	 */
	public static function color( array $extra = [] ): array {
		return array_merge(
			[
				'type'    => 'color',
				'formats' => [ 'hex', 'rgba' ]
			],
			$extra
		);
	}


	public static function boolean( array $extra = [] ): array {
		return array_merge(
			[
				'type' => 'boolean'
			],
			$extra
		);
	}
}