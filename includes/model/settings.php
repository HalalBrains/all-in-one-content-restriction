<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Exlac;

class Settings {

	public static function get() {
		$settings                      = get_option( 'heymehedi_exlac_settings' );
		$settings['post_type']         = isset( $settings['post_type'] ) ? $settings['post_type'] : 'post';
		$settings['restriction_wise']  = isset( $settings['restriction_wise'] ) ? $settings['restriction_wise'] : 'category';
		$settings['category_ids']      = isset( $settings['category_ids'] ) ? $settings['category_ids'] : array();
		$settings['single_post_ids']   = isset( $settings['single_post_ids'] ) ? $settings['single_post_ids'] : array();
		$settings['active_wise_index'] = $settings['restriction_wise'] . '_ids';
		$settings['role_names']        = isset( $settings['role_names'] ) ? $settings['role_names'] : array();
		$settings['the_content']       = isset( $settings['the_content'] ) ? self::before_get( $settings['the_content'] ) : '';
		$settings['the_title']         = isset( $settings['the_title'] ) ? $settings['the_title'] : '';

		return $settings;
	}

	public static function set( $data ) {
		$settings                     = self::get();
		$ids                          = $data['itemIds'];
		$ids_by_wise                  = $data['restrictionWise'] . '_ids';
		$settings['post_type']        = $data['posttype'];
		$settings['restriction_wise'] = $data['restrictionWise'];
		$settings['role_names']       = $data['roleNames'];
		$settings['the_title']        = $data['theTitle'];
		$settings['the_content']      = self::before_set( $data['theContent'] );
		$settings[$ids_by_wise]       = $ids;

		update_option( 'heymehedi_exlac_settings', $settings, true );
	}

	protected static function before_set( $data ) {
		return sanitize_textarea_field( htmlentities( $data ) );
	}

	protected static function before_get( $data ) {
		return stripslashes( wp_specialchars_decode( $data, ENT_QUOTES, 'UTF-8' ) );
	}

}