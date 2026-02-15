<?php
/**
 * Example Ajax Handler.
 *
 * @package Dogtronic
 */

namespace Dogtronic\Ajax;

class ExampleAjax {

	/**
	 * Construct.
	 */
	public function __construct() {
		add_action( 'wp_ajax_dogtronic_example', [ $this, 'handle_request' ] );
		add_action( 'wp_ajax_nopriv_dogtronic_example', [ $this, 'handle_request' ] );
	}

	/**
	 * Handle Ajax Request.
	 */
	public function handle_request() {
		check_ajax_referer( 'dogtronic_ajax_nonce', 'nonce' );

		// Simulation processing
		$response = [
			'status'  => 'success',
			'message' => 'Ajax request handled successfully!',
            'data'    => $_POST,
		];

		wp_send_json_success( $response );
	}
}
