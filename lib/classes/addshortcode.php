<?php
class Timezone_Search_AddShortcode {

	public function __construct() {}

	/**
	 * Static Singleton Factory Method
	 *
	 * @since  4.1
	 * @return Tribe__Events__Shortcode__Event_Details
	 */
	public static function instance() {
		static $instance;

		if ( ! $instance ) {
			$instance = new self;
		}

		return $instance;
	}

	/**
	 * Add the necessary hooks at the correct moment in WordPress
	 *
	 * @since  4.1
	 * @return  void
	 */
	public static function hook() {
		$myself = self::instance();

		add_action( 'init', array( $myself, 'add_shortcode' ) );
	}
	/**
	 * This will be called at hook "init" to allow other plugins and themes to hook to shortcode easily
	 *
	 * @since 4.1
	 * @return void
	 */
	public function add_shortcode() {
		add_shortcode( 'd2l_gm_tz', array( $this, 'do_shortcode' ) );
	}

	/**
	 * Actually create the shortcode output
	 *
	 * @since  4.1
	 *
	 * @param  array $args    The Shortcode arguments
	 *
	 * @return string
	 */
	public function do_shortcode( $args ) {

		// Start to record the Output
		ob_start(); ?>

	<div id="gm_tz_widget">
		<input type="text" id="tz-search-input">
		<button type="submit" id="search-tz">Submit</button>
		<label id="tz-placeholder"></label>
	</div><?php

		// Save it to a variable
		$html = ob_get_clean();


		return $html;
	}

}