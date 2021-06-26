<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Content_Restriction;

use HeyMehedi\Content_Restriction\Settings;

class Update {

	public static function save_setting_data( $data ) {
		$settings                     = Settings::get_settings();
		$ids                          = $data['itemIds'];
		$ids_by_wise                  = $data['restrictionWise'] . '_ids';
		$settings['post_type']        = $data['posttype'];
		$settings['restriction_wise'] = $data['restrictionWise'];
		$settings[$ids_by_wise]       = $ids;

		update_option( 'heymehedi_content_restriction_settings', $settings, true );
	}

	protected function sanitize() {
		//
	}
}