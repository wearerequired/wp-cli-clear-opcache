<?php

namespace Required\ClearOpcache;

function bootstrap() {
	add_action( 'init', __NAMESPACE__ . '\\clear_cache' );
}

function clear_cache() {
	if ( isset( $_GET['action'], $_GET['_nonce'] ) && 'clear-opcache' === wp_unslash( $_GET['action'] ) ) {
		$nonce = wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_nonce'] ) ), 'clear-opcache' );

		if ( ! $nonce ) {
			status_header( 400 );
			die();
		}

		$reset = opcache_reset();

		if ( ! $reset ) {
			status_header( 400 );
			die();
		}

		status_header( 202 );
		die();
	}
}
