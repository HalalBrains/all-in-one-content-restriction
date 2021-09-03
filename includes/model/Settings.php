<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Settings {

	public static function get( $restriction_id = null ) {

		$settings['restrictions'] = array();
		$settings                 = get_option( 'all_in_one_content_restriction_settings' );

		// if ( $restriction_id && ! empty( $settings['restrictions'] ) ) {
		// 	foreach ( $settings['restrictions'] as $key => $value ) {
		// 		echo 'hello';
		// 	}
		// }

		// $settings['title']            = isset( $settings['title'] ) ? $settings['title'] : '';
		// $settings['post_type']        = isset( $settings['post_type'] ) ? $settings['post_type'] : 'posts';
		// $settings['restrict_in']      = isset( $settings['restrict_in'] ) ? $settings['restrict_in'] : 'category';
		// $settings['category_ids']     = isset( $settings['category_ids'] ) ? $settings['category_ids'] : array();
		// $settings['single_post_ids']  = isset( $settings['single_post_ids'] ) ? $settings['single_post_ids'] : array();
		// $settings['active_index']     = $settings['restrict_in'] . '_ids';
		// $settings['role_names']       = isset( $settings['role_names'] ) ? $settings['role_names'] : array();
		// $settings['protection_type']  = isset( $settings['protection_type'] ) ? $settings['protection_type'] : 'override_contents';
		// $settings['redirection_type'] = isset( $settings['redirection_type'] ) ? $settings['redirection_type'] : 'login';
		// $settings['the_title']        = isset( $settings['the_title'] ) ? $settings['the_title'] : '';
		// $settings['the_excerpt']      = isset( $settings['the_excerpt'] ) ? stripslashes( wp_specialchars_decode( $settings['the_excerpt'], ENT_QUOTES, 'UTF-8' ) ) : '';
		// $settings['the_content']      = isset( $settings['the_content'] ) ? stripslashes( wp_specialchars_decode( $settings['the_content'], ENT_QUOTES, 'UTF-8' ) ) : '';
		// $settings['custom_url']       = isset( $settings['custom_url'] ) ? $settings['custom_url'] : '';

		return $settings;
	}

	public static function set( $data ) {
		$msg                     = array();
		$settings                = self::get();
		$single_restriction_data = array();

		$single_restriction_data['restriction_id'] = sanitize_text_field( $data['restriction_id'] );
		$single_restriction_data['title']          = sanitize_text_field( $data['title'] );
		$single_restriction_data['post_type']      = sanitize_text_field( $data['post_type'] );
		$single_restriction_data['restriction_in'] = sanitize_text_field( $data['restriction_in'] );
		$single_restriction_data['role_names']     = self::sanitize_array( $data['role_names'] );

		// $ids                                          = self::sanitize_array( $data['itemIds'] );
		// $single_restriction_data['post_type']         = sanitize_text_field( $data['posttype'] );
		// $single_restriction_data['restrict_in']       = sanitize_text_field( $data['restrictionIn'] );
		// $ids_by_restrict_in                           = $single_restriction_data['restrict_in'] . '_ids';

		// $single_restriction_data['protection_type']  = sanitize_text_field( $data['protectionType'] );
		// $single_restriction_data['redirection_type'] = sanitize_text_field( $data['redirectionType'] );
		// $single_restriction_data['the_title']        = sanitize_text_field( $data['theTitle'] );
		// $single_restriction_data['the_excerpt']      = sanitize_textarea_field( htmlentities( $data['theExcerpt'] ) );
		// $single_restriction_data['the_content']      = sanitize_textarea_field( htmlentities( $data['theContent'] ) );
		// $single_restriction_data['custom_url']       = esc_url( $data['customUrl'] );
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
			$is_submitted = update_option( 'all_in_one_content_restriction_settings', $settings, true );

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

		foreach ( $settings['restrictions'] as $key => $value ) {
			if ( $value['restriction_id'] == $data['restriction_id'] ) {
				unset( $settings['restrictions'][$key] );
				break;
			}
		}
		e_var_dump( $settings );

		if ( user_can( wp_get_current_user(), 'manage_options' ) ) {
			update_option( 'all_in_one_content_restriction_settings', $settings, true );

			echo 'done';

			return;
		}

		echo 'nothing';

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