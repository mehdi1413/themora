<?php
/**
 * Field Validator: Media Field
 *
 * @package Themora
 */

namespace Themora\Inc\Settings\Validators;

use Themora\Inc\Settings\Contracts\ValidatorInterface;

defined( 'ABSPATH' ) || exit;

class MediaFieldValidator implements ValidatorInterface {

	public function validate( $value, array $rules = [] ): ?int {
		$value = absint( $value );

		if ( ! $value ) {
			return 0;
		}

		$attachment = get_post( $value );

		if ( ! $attachment || $attachment->post_type !== 'attachment' ) {
			return null;
		}

		if ( isset( $rules['fileType'] ) ) {
			$type = wp_attachment_is_image( $value ) ? 'image' : 'file';

			if ( $type !== $rules['fileType'] ) {
				return 0;
			}
		}

		return $value;
	}
}