<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.6.4
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Settings {

	public static function get( $restriction_id = null ) {
		$settings['restrictions'] = array();
		$settings                 = get_option( 'all_in_one_content_restriction_settings' );

		return apply_filters( 'all_in_one_content_restriction_get_settings', $settings );
	}

	public static function set( $data ) {
		$msg         = array();
		$settings    = self::get();
		$restriction = array();

		$restriction['restriction_id'] = sanitize_text_field( $data['restriction_id'] );

		$restriction['title']    = sanitize_text_field( $data['title'] );
		$restriction['priority'] = sanitize_text_field( $data['priority'] );

		$restriction['post_type']   = sanitize_text_field( $data['post_type'] );
		$restriction['restrict_in'] = sanitize_text_field( $data['restrict_in'] );

		$restriction['protection_type'] = sanitize_text_field( $data['protection_type'] );

		$restriction['user_restriction_type'] = self::sanitize_array( $data['user_restriction_type'] );
		$restriction['role_names']            = self::sanitize_array( $data['role_names'] );
		$restriction['specify_users']         = self::sanitize_array( $data['specify_users'] );

		$restriction['selected_ids'] = self::sanitize_array( $data['selected_ids'] );

		$restriction['protection_type'] = sanitize_text_field( $data['protectionType'] );

		// #1 Override Contents
		$restriction['the_title']   = sanitize_text_field( $data['the_title'] );
		$restriction['the_excerpt'] = sanitize_textarea_field( htmlentities( $data['the_excerpt'] ) );
		$restriction['the_content'] = sanitize_textarea_field( htmlentities( $data['the_content'] ) );

		// #2 Redirections
		$restriction['redirection_type'] = sanitize_text_field( $data['redirectionType'] );
		$restriction['custom_url']       = esc_url( $data['customUrl'] );

		// #3 Blur
		$restriction['spread']        = sanitize_text_field( $data['spread'] );
		$restriction['blur_level']    = sanitize_text_field( $data['blur_level'] );
		$restriction['blur_apply_to'] = self::sanitize_array( $data['blur_apply_to'] );

		// #4 Obfuscate
		$restriction['obfuscate_apply_to'] = self::sanitize_array( $data['obfuscate_apply_to'] );

		if ( 'new' === $data['action_type'] ) {
			$restriction['restriction_id'] = self::create_restriction_id( $settings );
			$settings['restrictions'][]    = $restriction;
			$msg['restriction_id']         = $restriction['restriction_id'];
		}

		if ( 'edit' === $data['action_type'] && ! empty( $data['restriction_id'] ) ) {
			foreach ( $settings['restrictions'] as $key => $value ) {
				if ( $value['restriction_id'] == $data['restriction_id'] ) {
					$settings['restrictions'][$key] = $restriction;
				}
			}
		}

		if ( user_can( wp_get_current_user(), 'manage_options' ) ) {
			$is_submitted = update_option( 'all_in_one_content_restriction_settings', apply_filters( 'all_in_one_content_restriction_set_settings', $settings ), true );

			if ( $is_submitted ) {
				$msg['msg'] = Strings::get()[123];
			} else {
				$msg['msg'] = Strings::get()[124];
			}

			$msg = json_encode( $msg );

			echo $msg;
		}

	}

	public static function drop( $data ) {
		$settings = self::get();

		if ( 'trash' === $data['action'] ) {
			foreach ( $settings['restrictions'] as $key => $value ) {
				if ( in_array( $value['restriction_id'], $data['aiocr_id'] ) ) {
					unset( $settings['restrictions'][$key] );
				}
			}
		} else {
			foreach ( $settings['restrictions'] as $key => $value ) {
				if ( $value['restriction_id'] == $data['restriction_id'] ) {
					unset( $settings['restrictions'][$key] );
					break;
				}
			}
		}

		if ( user_can( wp_get_current_user(), 'manage_options' ) ) {
			update_option( 'all_in_one_content_restriction_settings', $settings, true );

			return;
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

	private static function create_restriction_id( $settings ) {
		$temp_max = 0;
		if ( isset( $settings['restrictions'] ) && ! empty( $settings['restrictions'] ) ) {
			foreach ( $settings['restrictions'] as $key => $value ) {
				$temp_max = max( $value['restriction_id'], $temp_max );
			}
		}

		return $temp_max + 1;
	}
}