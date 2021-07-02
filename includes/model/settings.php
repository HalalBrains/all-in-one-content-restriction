<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Content_Restriction;

class Settings {

	public static function get() {
		$settings                      = get_option( 'heymehedi_content_restriction_settings' );
		$settings['post_type']         = isset( $settings['post_type'] ) ? $settings['post_type'] : 'post';
		$settings['restriction_wise']  = isset( $settings['restriction_wise'] ) ? $settings['restriction_wise'] : 'category';
		$settings['category_ids']      = isset( $settings['category_ids'] ) ? $settings['category_ids'] : array();
		$settings['single_post_ids']   = isset( $settings['single_post_ids'] ) ? $settings['single_post_ids'] : array();
		$settings['active_wise_index'] = $settings['restriction_wise'] . '_ids';
		$settings['role_names']        = isset( $settings['role_names'] ) ? $settings['role_names'] : array();

		return $settings;
	}

	public static function set( $data ) {
		$settings                     = self::get();
		$ids                          = $data['itemIds'];
		$ids_by_wise                  = $data['restrictionWise'] . '_ids';
		$settings['post_type']        = $data['posttype'];
		$settings['restriction_wise'] = $data['restrictionWise'];
		$settings['role_names']       = $data['roleNames'];
		$settings[$ids_by_wise]       = $ids;

		update_option( 'heymehedi_content_restriction_settings', $settings, true );
	}

	protected function sanitize() {
		// i will sanitize before update data to settings. for testing skipping it....
	}

}