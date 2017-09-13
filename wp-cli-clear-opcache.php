<?php
/**
 * Plugin Name: WP-CLI Clear OPcache
 * Plugin URI:  https://github.com/wearerequired/wp-cli-clear-opcache
 * Description: Use WP-CLI to clear the OPcache for a site via HTTP.
 * Version:     1.0.0
 * Author:      required
 * Author URI:  https://required.com
 * License:     GPL v2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * Copyright (c) 2017 required (email: info@required.ch)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @package Required\ClearOpcache
 */

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require __DIR__ . '/vendor/autoload.php';
}

add_action( 'plugins_loaded', '\Required\ClearOpcache\maybe_clear_cache', 1 );

if ( ! class_exists( 'WP_CLI' ) ) {
	return;
}

if ( ! class_exists( 'Required\\ClearOpcache\\CLI_Command' ) ) {
	trigger_error( sprintf( '%s does not exist. Check Composer\'s autoloader.',  'Required\\ClearOpcache\\CLI_Command' ), E_USER_WARNING );

	return;
}

WP_CLI::add_command( 'opcache', \Required\ClearOpcache\CLI_Command::class );
