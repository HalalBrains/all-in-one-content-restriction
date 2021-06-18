<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Content_Restriction;

class Update {

	protected static $instance = null;

	public function __construct() {

	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public static function settings_data( $data ) {

		$posttype = $data['posttype'];

		print_r( $data );

		wp_die();
	}
}

Update::instance();