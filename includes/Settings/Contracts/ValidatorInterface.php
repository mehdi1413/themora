<?php
/**
 * Validator Interface Class
 *
 * @package Themora
 */

namespace Themora\Inc\Settings\Contracts;

defined( 'ABSPATH' ) || exit;

interface ValidatorInterface {

	public function validate( $value, array $rules = [] );
}