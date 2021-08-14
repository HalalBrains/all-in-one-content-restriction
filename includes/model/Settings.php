<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Settings {

	public static function get() {
		$settings                     = get_option( 'all_in_one_content_restriction_settings' );
		$settings['post_type']        = isset( $settings['post_type'] ) ? $settings['post_type'] : 'posts';
		$settings['restrict_in']      = isset( $settings['restrict_in'] ) ? $settings['restrict_in'] : 'category';
		$settings['category_ids']     = isset( $settings['category_ids'] ) ? $settings['category_ids'] : array();
		$settings['single_post_ids']  = isset( $settings['single_post_ids'] ) ? $settings['single_post_ids'] : array();
		$settings['active_index']     = $settings['restrict_in'] . '_ids';
		$settings['role_names']       = isset( $settings['role_names'] ) ? $settings['role_names'] : array();
		$settings['protection_type']  = isset( $settings['protection_type'] ) ? $settings['protection_type'] : 'override_contents';
		$settings['redirection_type'] = isset( $settings['redirection_type'] ) ? $settings['redirection_type'] : 'login';
		$settings['the_title']        = isset( $settings['the_title'] ) ? $settings['the_title'] : '';
		$settings['the_excerpt']      = isset( $settings['the_excerpt'] ) ? stripslashes( wp_specialchars_decode( $settings['the_excerpt'], ENT_QUOTES, 'UTF-8' ) ) : '';
		$settings['the_content']      = isset( $settings['the_content'] ) ? stripslashes( wp_specialchars_decode( $settings['the_content'], ENT_QUOTES, 'UTF-8' ) ) : '';
		$settings['custom_url']       = isset( $settings['custom_url'] ) ? $settings['custom_url'] : '';

		return $settings;
	}

	public static function set( $data ) {
		$settings                      = self::get();
		$ids                           = self::sanitize_array( $data['itemIds'] );
		$settings['post_type']         = sanitize_text_field( $data['posttype'] );
		$settings['restrict_in']       = sanitize_text_field( $data['restrictionIn'] );
		$ids_by_restrict_in            = $settings['restrict_in'] . '_ids';
		$settings['role_names']        = self::sanitize_array( $data['roleNames'] );
		$settings['protection_type']   = sanitize_text_field( $data['protectionType'] );
		$settings['redirection_type']  = sanitize_text_field( $data['redirectionType'] );
		$settings['the_title']         = sanitize_text_field( $data['theTitle'] );
		$settings['the_excerpt']       = sanitize_textarea_field( htmlentities( $data['theExcerpt'] ) );
		$settings['the_content']       = sanitize_textarea_field( htmlentities( $data['theContent'] ) );
		$settings['custom_url']        = esc_url( $data['customUrl'] );
		$settings[$ids_by_restrict_in] = $ids;

		if ( user_can( wp_get_current_user(), 'manage_options' ) ) {
			$is_submitted = update_option( 'all_in_one_content_restriction_settings', $settings, true );

			if ( $is_submitted ) {
				echo Strings::get()[123];
			} else {
				echo Strings::get()[124];
			}
		}

	}

	private static function sanitize_array( $array ) {

		foreach ( $array as &$value ) {
			if ( ! is_array( $value ) ) {
				// Sanitize if value is not an array
				$value = sanitize_text_field( $value );
			} else {
				// Do inside this function again
				self::sanitize_array( $value );
			}
		}

		return $array;
	}
}