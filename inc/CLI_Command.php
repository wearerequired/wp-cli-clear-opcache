<?php

namespace Required\ClearOpcache;

use WP_CLI;
use WP_CLI_Command;

class CLI_Command extends WP_CLI_Command {
	/**
	 * Clear the OPcache for the current WordPress site.
	 *
	 * ## EXAMPLES
	 *
	 *     # Clear the OPcache for the website.
	 *     $ wp opcache clear
	 */
	public function clear(): void {
		$response = wp_remote_post(
			add_query_arg( [
				'opcache_action' => 'clear-opcache',
				'opcache_nonce'  => wp_create_nonce( 'clear-opcache' ),
			], home_url( '/' ) ),
			[
				'sslverify' => false,
			]
		);

		if ( is_wp_error( $response ) ) {
			WP_CLI::error( 'There was an error clearing the OPcache: ' . $response->get_error_message() );
		}

		$status = wp_remote_retrieve_response_code( $response );

		if ( 401 === $status ) {
			WP_CLI::error( 'It seems like your site requires some sort of authentication. Please allow your server\'s IP address to bypass authentication.' );
		}

		if ( 400 === $status ) {
			WP_CLI::error( 'There was an unknown error clearing the OPcache. Maybe OPcache is disabled?' );
		}

		if ( 202 === $status ) {
			WP_CLI::success( 'The OPcache was successfully cleared!' );

			return;
		}

		WP_CLI::error( 'There was an unknown error clearing the OPcache.' );
	}

	/**
	 * Invalidates a cached script for the current WordPress site.
	 *
	 * ## OPTIONS
	 *
	 * <script>
	 * : The path to the script being invalidated.
	 *
	 * [--force]
	 * : Force invalidation, even if not necessary.
	 *
	 * ## EXAMPLES
	 *
	 *     # Invalidate a cached script.
	 *     $ wp opcache invalidate foo/bar.php
	 */
	public function invalidate( array $args, array $assoc_args ): void {
		$response = wp_remote_post(
			add_query_arg( [
				'opcache_action' => 'clear-opcache',
				'opcache_script' => $args['script'],
				'opcache_force'  => $assoc_args['force'],
				'opcache_nonce'  => wp_create_nonce( 'clear-opcache' ),
			], home_url( '/' ) ),
			[
				'sslverify' => false,
			]
		);

		if ( is_wp_error( $response ) ) {
			WP_CLI::error( 'There was an error clearing the OPcache: ' . $response->get_error_message() );
		}

		$status = wp_remote_retrieve_response_code( $response );

		if ( 401 === $status ) {
			WP_CLI::error( 'It seems like your site requires some sort of authentication. Please allow your server\'s IP address to bypass authentication.' );
		}

		if ( 400 === $status ) {
			WP_CLI::error( 'There was an unknown error clearing the OPcache. Maybe OPcache is disabled?' );
		}

		if ( 202 === $status ) {
			WP_CLI::success( sprintf( 'The OPcache was successfully invalidated for %s', $args['script'] ) );

			return;
		}

		WP_CLI::error( 'There was an unknown error invalidating the OPcache.' );
	}
}
