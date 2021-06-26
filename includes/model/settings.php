<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Content_Restriction;

class Settings {

	public static function get_settings() {
		$settings                      = get_option( 'heymehedi_content_restriction_settings' );
		$settings['post_type']         = isset( $settings['post_type'] ) ? $settings['post_type'] : 'post';
		$settings['restriction_wise']  = isset( $settings['restriction_wise'] ) ? $settings['restriction_wise'] : 'category';
		$settings['category_ids']      = isset( $settings['category_ids'] ) ? $settings['category_ids'] : array();
		$settings['single_post_ids']   = isset( $settings['single_post_ids'] ) ? $settings['single_post_ids'] : array();
		$settings['active_wise_index'] = $settings['restriction_wise'] . '_ids';

		return $settings;
	}

}