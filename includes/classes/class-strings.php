<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Exlac;

class Strings {

	protected static $instance = null;

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public static function get() {
		return array(
			100 => __( 'Exlac', 'exlac' ),
			101 => __( 'Sorry, no items found!', 'exlac' ),
			123 => __( 'Saved Successfully', 'exlac' ),
			124 => __( 'No changes made', 'exlac' ),
		);
	}
}

Strings::instance();