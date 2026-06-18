<?php
/**
 * Setting Default Options
 *
 * @package Themora
 */

namespace Themora\Inc\Settings;

defined( 'ABSPATH' ) || exit;

class Defaults {

	public static function get(): array {
		return [
			'general' => [
				'title'     => '',
				'showTitle' => true,
				'selectOne' => 'DESC'
			],

			'archive' => [
				'removePrefix' => false,
				'perPage'      => 12
			]

		];
	}
}