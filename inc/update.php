<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Content_Restriction;

use HeyMehedi\Content_Restriction;

class Update {

	public static function save_setting_data( $data ) {
		update_option( Content_Restriction::$options_name, $data, true );
	}

	protected function sanitize() {
		//
	}
}

new Update;