<?php

namespace Mediavine\Challenge;

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

class Shortcodes extends Plugin {

	private static $instance = null;

	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self;
			self::$instance->init();
		}
		return self::$instance;
	}

	function mv_random_posts_shortcode_handler($atts) {

		$url = 'http://mvengineeringtest.local/wp-json/mv-challenge/v1/random/';

		$atts = shortcode_atts(
				array(
					'limit' => '5',
					'author' => ' ',
					'category' => ' ',
					'orderby'   => 'rand',
					'list_type' => 'ul'
				), $atts, 'mv_random_posts' );

		$atts['numberposts'] = $atts['limit'];
		$query_string = http_build_query($atts);
		$url .= '?' . $query_string;
		$response = wp_remote_get( $url );

		if( is_wp_error( $response ) ) {
			return false;
		}

		$data = json_decode( $response['body'] );
		$html = '<' . $atts['list_type'] . '>';
		foreach( $data as $post ) {
				$html .= '<li>';
				$html .= '<a href="' . esc_url( $post->guid ) . '">' . $post->post_title . '</a>';
				$html .= '</li>';
			}
		$html .= '</' . $atts['list_type'] . '>';

		return $html;
		}

	public function init() {
		// TODO: Add shortcode creation hook for shortcode `mv_random_posts`


		add_shortcode('mv_random_posts', [ $this, 'mv_random_posts_shortcode_handler' ] );
	}

	// TODO: Add shortcode named `mv_random_posts` to output an unordered list of the random posts
	// Use the newly created endpoint to retrieve this data and output on the page
	// Add params named `limit`, 'author', and 'category' to filter the posts
	// Add a hook to change the output to an ordered list
}
