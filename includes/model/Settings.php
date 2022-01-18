<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.4
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Settings {

	public static function get( $restriction_id = null ) {
		$settings['restrictions'] = array();
		$settings                 = get_option( 'all_in_one_content_restriction_settings' );

		return apply_filters( 'all_in_one_content_restriction_get_settings', $settings );
	}

	public static function set( $data ) {
		$msg                     = array();
		$settings                = self::get();
		$single_restriction_data = array();

		$single_restriction_data['restriction_id'] = sanitize_text_field( $data['restriction_id'] );

		$single_restriction_data['title']    = sanitize_text_field( $data['title'] );
		$single_restriction_data['priority'] = sanitize_text_field( $data['priority'] );

		$single_restriction_data['post_type']   = sanitize_text_field( $data['post_type'] );
		$single_restriction_data['restrict_in'] = sanitize_text_field( $data['restrict_in'] );

		$single_restriction_data['protection_type'] = sanitize_text_field( $data['protection_type'] );
		$single_restriction_data['role_names']      = self::sanitize_array( $data['role_names'] );
		$single_restriction_data['selected_ids']    = self::sanitize_array( $data['selected_ids'] );

		$single_restriction_data['protection_type'] = sanitize_text_field( $data['protectionType'] );

		// #1 Override Contents
		$single_restriction_data['the_title']   = sanitize_text_field( $data['the_title'] );
		$single_restriction_data['the_excerpt'] = sanitize_textarea_field( htmlentities( $data['the_excerpt'] ) );
		$single_restriction_data['the_content'] = sanitize_textarea_field( htmlentities( $data['the_content'] ) );

		// #2 Redirections
		$single_restriction_data['redirection_type'] = sanitize_text_field( $data['redirectionType'] );
		$single_restriction_data['custom_url']       = esc_url( $data['customUrl'] );

		// #3 Blur
		$single_restriction_data['spread']        = sanitize_text_field( $data['spread'] );
		$single_restriction_data['blur_level']    = sanitize_text_field( $data['blur_level'] );
		$single_restriction_data['blur_apply_to'] = self::sanitize_array( $data['blur_apply_to'] );

		// $ids                                          = self::sanitize_array( $data['itemIds'] );
		// $ids_by_restrict_in                           = $single_restriction_data['restrict_in'] . '_ids';
		// $single_restriction_data[$ids_by_restrict_in] = $ids;

		if ( 'new' === $data['action_type'] ) {
			$single_restriction_data['restriction_id'] = self::create_restriction_id( $settings );
			$settings['restrictions'][]                = $single_restriction_data;
			$msg['restriction_id']                     = $single_restriction_data['restriction_id'];
		}

		if ( 'edit' === $data['action_type'] && ! empty( $data['restriction_id'] ) ) {
			foreach ( $settings['restrictions'] as $key => $value ) {
				if ( $value['restriction_id'] == $data['restriction_id'] ) {
					$settings['restrictions'][$key] = $single_restriction_data;
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