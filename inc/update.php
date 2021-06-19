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

		$posttype = $data['posttype'];
		$item_ids = $data['itemIds'];

		update_option(Content_Restriction::$options, $data, true );

		// $options = get_option( Content_Restriction::$options, array() );
		// self::$options = $options;

		// print_r( $data );
	}

	protected function sanitize() {
		//
	}
}

new Update;