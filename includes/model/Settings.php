<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\AIO_Content_Restriction;

class Settings {

	public static function get() {
		$settings                     = get_option( 'aio_content_restriction_settings' );
		$settings['post_type']        = isset( $settings['post_type'] ) ? $settings['post_type'] : 'posts';
		$settings['restrict_in']      = isset( $settings['restrict_in'] ) ? $settings['restrict_in'] : 'category';
		$settings['category_ids']     = isset( $settings['category_ids'] ) ? $settings['category_ids'] : array();
		$settings['single_post_ids']  = isset( $settings['single_post_ids'] ) ? $settings['single_post_ids'] : array();
		$settings['active_index']     = $settings['restrict_in'] . '_ids';
		$settings['role_names']       = isset( $settings['role_names'] ) ? $settings['role_names'] : array();
		$settings['protection_type']  = isset( $settings['protection_type'] ) ? $settings['protection_type'] : 'override_contents';
		$settings['redirection_type'] = isset( $settings['redirection_type'] ) ? $settings['redirection_type'] : 'login';
		$settings['the_title']        = isset( $settings['the_title'] ) ? $settings['the_title'] : '';
		$settings['the_excerpt']      = isset( $settings['the_excerpt'] ) ? $settings['the_excerpt'] : '';
		$settings['the_content']      = isset( $settings['the_content'] ) ? self::before_get( $settings['the_content'] ) : '';
		$settings['custom_url']       = isset( $settings['custom_url'] ) ? self::before_get( $settings['custom_url'] ) : '';

		return $settings;
	}

	public static function set( $data ) {
		$settings                     = self::get();
		$ids                          = $data['itemIds'];
		$ids_by_in                    = $data['restrictionIn'] . '_ids';
		$settings['post_type']        = $data['posttype'];
		$settings['restrict_in']      = $data['restrictionIn'];
		$settings['role_names']       = $data['roleNames'];
		$settings['protection_type']  = $data['protectionType'];
		$settings['redirection_type'] = $data['redirectionType'];
		$settings['the_title']        = $data['theTitle'];
		$settings['the_excerpt']      = $data['theExcerpt'];
		$settings['the_content']      = self::before_set( $data['theContent'] );
		$settings['custom_url']       = self::before_set( $data['customUrl'] );
		$settings[$ids_by_in]         = $ids;

		$is_submitted = update_option( 'aio_content_restriction_settings', $settings, true );

		if ( $is_submitted ) {
			echo Strings::get()[123];
		} else {
			echo Strings::get()[124];
		}
	}

	protected static function before_set( $data ) {
		return sanitize_textarea_field( htmlentities( $data ) );
	}

	protected static function before_get( $data ) {
		return stripslashes( wp_specialchars_decode( $data, ENT_QUOTES, 'UTF-8' ) );
	}
}