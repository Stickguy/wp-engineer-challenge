<?php
/**
 * Plugin Name:       Mediavine WP Engineer Challenge
 * Plugin URI:        https://www.mediavine.com/
 * Description:       Simple coding challenge for a WordPress Engineer
 * Version:           1.0.0

 * Author:            Mediavine
 * Author URI:        https://www.mediavine.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This plugin requires WordPress' );
}

function mv_challenge_is_compatible() {
	global $wp_version;
	$wp         = '5.0';
	$php        = '5.6.40';
	$compatible = true;

	if ( version_compare( PHP_VERSION, $php ) < 0 ) {
		$compatible = false;
	}

	if ( version_compare( $wp_version, $wp ) < 0 ) {
		$compatible = false;
	}

	return $compatible;
}

function mv_challenge_incompatible_notice() {
	if ( ! mv_challenge_is_compatible() ) {
		printf(
			'<div class="notice notice-error"><p>%1$s</p></div>',
			wp_kses_post( __( '<strong>Mediavine WP Engineer Challenge</strong> requires PHP 5.6.40 or higher, WordPress 5.0 or higher.  Please upgrade your hosting and/or WordPress.', 'mediavine' ) )
		);
		printf(
			'<div class="notice notice-error"><p><em>%1$s</em></p></div>',
			wp_kses_post( __( 'The plugin has been deactivated.', 'mediavine' ) )
		);
		deactivate_plugins( plugin_basename( __FILE__ ) );
		return;
	}
}

if ( ! mv_challenge_is_compatible() ) {
	return;
}

require_once( 'class-plugin.php' );
