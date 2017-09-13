<?php

namespace Required\ClearOpcache;

function bootstrap() {
	add_action( 'init', '\Required\ClearOpcache\clear_cache' );
}

function clear_cache() {
	if ( isset( $_GET['opcache_action'], $_GET['opcache_nonce'] ) && 'clear-opcache' === $_GET['opcache_action'] ) {
		$nonce = wp_verify_nonce( $_GET['opcache_nonce'], 'clear-opcache' );

		if ( ! $nonce ) {
			status_header( 400 );
			die();
		}

		if ( isset( $_GET['opcache_script'] ) ) {
			if ( opcache_invalidate( wp_unslash( $_GET['opcache_script'] ), isset( $_GET['opcache_force'] ) ) ) {
				status_header( 202 );
			} else {
				status_header( 400 );
			}
		} else {
			if ( opcache_reset() ) {
				status_header( 202 );
			} else {
				status_header( 400 );
			}
		}

		die();
	}
}
