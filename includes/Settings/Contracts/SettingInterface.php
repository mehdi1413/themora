<?php
/**
 * Setting Contract
 *
 * @package Themora
 */

namespace Themora\Inc\Settings\Contracts;

defined( 'ABSPATH' ) || exit;

interface SettingInterface {
	public function validate( array $input ): array;
}