<?php
/**
 * Rest Controller Class: Media
 *
 * @package Themora
 */

namespace Themora\Inc\Rest;

use Themora\Inc\Traits\Singleton;
use WP_REST_Request;
use WP_REST_Response;

defined( 'ABSPATH' ) || exit;

class MediaController {
	use Singleton;

	public function register_routes(): void {
		register_rest_route(
			'themora/v1',
			'/media/(?P<id>\d+)',
			[
				[
					'methods'             => 'GET',
					'callback'            => [ $this, 'get_media' ],
					'permission_callback' => [ $this, 'permission' ]
				]
			]
		);
	}

	public function permission(): bool {
		return true;
	}

	public function get_media( WP_REST_Request $request ): WP_REST_Response {
		$id = absint( $request->get_param( 'id' ) );

		if ( ! $id ) {
			return new WP_REST_Response(
				[
					'success' => false,
					'message' => 'Invalid attachment'
				],
				400
			);
		}

		$file = get_post( $id );

		if ( ! $file || $file->post_type !== 'attachment' ) {
			return new WP_REST_Response(
				[
					'success' => false,
					'message' => 'File not found'
				],
				404
			);
		}

		$data = [
			'id'       => $id,
			'url'      => wp_get_attachment_url( $id ),
			'filename' => basename( get_attached_file( $id ) ),
			'type'     => get_post_mime_type( $id ),
			'title'    => $file->post_title
		];

		if ( wp_attachment_is_image( $id ) ) {
			$data['thumb'] = wp_get_attachment_image_url( $id, 'thumbnail' );
		}

		return new WP_REST_Response(
			[
				'success' => true,
				'data'    => $data
			]
		);
	}
}