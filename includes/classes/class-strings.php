<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\AIO_Content_Restriction;

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
			100 => __( 'AIO Content Restriction', 'aio-content-restriction' ),
			101 => __( 'Sorry, no items found!', 'aio-content-restriction' ),
			123 => __( 'Saved Successfully', 'aio-content-restriction' ),
			124 => __( 'No changes made', 'aio-content-restriction' ),
		);
	}
}

Strings::instance();
