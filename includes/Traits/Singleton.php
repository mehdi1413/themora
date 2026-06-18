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

	final public static function getInstance() {
		static $instance = [];

		$called_class = get_called_class();

		if ( ! isset( $instance[ $called_class ] ) ) {
			$instance[ $called_class ] = new $called_class;
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