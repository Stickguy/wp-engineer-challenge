<?php

namespace Mediavine\Challenge;

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

class Routes extends Plugin {

	private static $instance = null;

	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self;
			self::$instance->init();
		}
		return self::$instance;
	}

	/**
* This is our callback function that embeds our phrase in a WP_REST_Response
*/
function prefix_get_endpoint_phrase($request) {
	// rest_ensure_response() wraps the data we want to return into a WP_REST_Response, and ensures it will be properly returned.
		$args = array(
			'numberposts' => ' ',
			'author' => ' ',
			'category' => ' '
		);
		$params = $request->get_params();
		$params = array_merge($args, $params);
		$latest_posts = get_posts( $params );
	return $latest_posts;
}

/**
* This function is where we register our routes for our example endpoint.
*/
function mv_random_posts() {
	// register_rest_route() handles more arguments but we are going to stick to the basics for now.

	register_rest_route( 'mv-challenge/v1', '/random', array(
			// By using this constant we ensure that when the WP_REST_Server changes our readable endpoints will work as intended.
			'methods'  => \WP_REST_Server::READABLE,
			// Here we register our callback. The callback is fired when this endpoint is matched by the WP_REST_Server class.
			'callback' => [$this, 'prefix_get_endpoint_phrase'],
	) );
}

	public function init() {
		// TODO: Add endpoint creation hook

add_action( 'rest_api_init', [$this, 'mv_random_posts'] );

	}

	// TODO: Add method to create an endpoint for http://{URL.test}/wp-json/mv-challenge/v1/random/{number_of_posts}
	// This read-only endpoint will randomly select posts from the site, using the number of posts as the limit.
	// Add the ability to filter results based on `author` and `category` params in the request data.
	// Return the response with the found posts
}
