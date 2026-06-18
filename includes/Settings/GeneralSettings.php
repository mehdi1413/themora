<?php
/**
 * General Setting Class
 *
 * @package Themora
 */

namespace Themora\Inc\Settings;

use Themora\Inc\Settings\Contracts\SettingInterface;

defined( 'ABSPATH' ) || exit;

class GeneralSettings implements SettingInterface {

	public function validate( array $input ): array {
		return [
			'title' => ! empty( $input['title'] ) ? sanitize_text_field( $input['title'] ) : '',
			'showTitle' => ! empty( $input['showTitle'] ),
			'selectOne' => in_array( $input['selectOne'] ?? 'DESC', [
				'ASC',
				'DESC'
			], true ) ? $input['selectOne'] : 'DESC'
		];
	}
}