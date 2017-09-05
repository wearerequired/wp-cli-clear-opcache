<?php

namespace Required\ClearOpcache;

class CLI_Command extends \WP_CLI_Command {
	/**
	 * Clear the Opcache for the current WordPress site.
	 *
	 * ## EXAMPLES
	 *
	 *     # Clear the Opcache for the website.
	 *     $ wp opcache clear
	 */
	public function __invoke( array $args, array $assoc_args ): void {
		$nonce = wp_create_nonce( 'clear-opcache' );

		$response = wp_remote_get( esc_url( add_query_arg( [
			'action' => 'clear-opcache',
			'_nonce' => $nonce,
		], home_url() ) ) );

		$status = wp_remote_retrieve_response_code( $response );

		if ( '' === $status ) {
			if ( is_wp_error( $response ) ) {
				/* @var \WP_Error $response */
				\WP_CLI::error( 'There was an error clearing the Opcache: ' . $response->get_error_message() );
			}

			\WP_CLI::error( 'There was an unknown error clearing the Opcache' );
		}

		if ( 400 === $status ) {
			\WP_CLI::error( 'There was an unknown error clearing the Opcache. Maybe Opcache is disabled?' );
		}

		if ( 202 === $status ) {
			\WP_CLI::success( 'The Opcache was successfully cleared!' );
		}
	}
}
