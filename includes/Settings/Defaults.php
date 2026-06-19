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

			'colors' => [
				'primary'   => [
					'main'      => '#c52f32',
					'secondary' => '#e89d26',
					'dark'      => '#222222',
					'grey'      => '#555555',
					'white'     => '#FFFFFF',
					'green'     => '#118E62',
					'blue'      => '#1B619A',
				],
				'secondary' => [
					'success' => '#118E62',
					'info'    => '#1B619A',
				]
			],

			'archive' => [
				'removePrefix' => false,
				'perPage'      => 12
			]

		];
	}
}