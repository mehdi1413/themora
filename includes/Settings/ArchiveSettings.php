<?php
/**
 * Archive Setting Class
 *
 * @package Themora
 */

namespace Themora\Inc\Settings;

use Themora\Inc\Settings\Contracts\SettingInterface;

defined( 'ABSPATH' ) || exit;

class ArchiveSettings implements SettingInterface {

	public function validate( array $input ): array {
		return [
			'removePrefix' => ! empty( $input['removePrefix'] ),
			'perPage'      => max( 1, min( 50, absint( $input['perPage'] ?? 12 ) ) )
		];
	}
}