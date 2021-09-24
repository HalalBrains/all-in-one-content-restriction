<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.1
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

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
			100 => __( 'All in One Content Restriction', 'all-in-one-content-restriction' ),
			101 => __( 'Nothing found!', 'all-in-one-content-restriction' ),
			123 => __( 'Saved Successfully', 'all-in-one-content-restriction' ),
			124 => __( 'No changes made', 'all-in-one-content-restriction' ),
		);
	}
}

Strings::instance();
