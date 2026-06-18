<?php
/**
 * Traits: Singleton
 *
 * @package Themora
 */

namespace Themora\Inc\Traits;

use Exception;

defined( 'ABSPATH' ) || exit;

trait Singleton {

	/**
	 * Singleton Instantiation Method
	 *
	 * @return static
	 */
	final public static function getInstance(): static {
		static $instance = [];

		$called_class = static::class;

		if ( ! isset( $instance[ $called_class ] ) ) {
			$instance[ $called_class ] = new static();
		}

		return $instance[ $called_class ];
	}

	private function __clone() {
	}

	private function __construct() {
	}

	/**
	 * @throws Exception
	 */
	final public function __wakeup() {
		throw new Exception( 'Singleton cannot be unserialized' );
	}
}