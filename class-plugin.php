<?php

namespace Mediavine\Challenge;

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

class Plugin {

	const VERSION = '1.0.0';

	private static $instance = null;

	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self;
			self::$instance->init();
		}
		return self::$instance;
	}

	public function init() {
		$this->Routes     = Routes::get_instance();
		$this->Shortcodes = Shortcodes::get_instance();
	}

	public static function assets_url() {
		return plugin_dir_url( __FILE__ );
	}
}

require_once( 'class-routes.php' );
require_once( 'class-shortcodes.php' );

$Plugin = Plugin::get_instance();
$Plugin->init();
