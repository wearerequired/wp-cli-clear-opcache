<?php

namespace Required\ClearOpcache;

class CLI_Command extends \WP_CLI_Command {
	/**
	 * Clear the OPcache for the current WordPress site.
	 *
	 * ## EXAMPLES
	 *
	 *     # Clear the OPcache for the website.
	 *     $ wp opcache clear
	 */
	public function __invoke( array $args, array $assoc_args ): void {
		$nonce = wp_create_nonce( 'clear-opcache' );

		$response = wp_remote_get( add_query_arg( [
			'opcache_action' => 'clear-opcache',
			'opcache_nonce' => $nonce,
		], home_url( '/' ) ) );

		if ( is_wp_error( $response ) ) {
			/* @var \WP_Error $response */
			\WP_CLI::error( 'There was an error clearing the OPcache: ' . $response->get_error_message() );
		}

		$status = wp_remote_retrieve_response_code( $response );

		if ( 401 === $status ) {
			\WP_CLI::error( 'It seems like your site requires some sort of authentication. Please allow your server\'s IP address to bypass authentication.' );
		}

		if ( 400 === $status ) {
			\WP_CLI::error( 'There was an unknown error clearing the OPcache. Maybe OPcache is disabled?' );
		}

		if ( 202 === $status ) {
			\WP_CLI::success( 'The OPcache was successfully cleared!' );

			return;
		}

		\WP_CLI::error( 'There was an unknown error clearing the OPcache.' );
	}
}
