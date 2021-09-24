<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.1
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

use HeyMehedi\All_In_One_Content_Restriction\Settings;

class Protection_Base {

	public $settings;
	public $matched_restrictions    = array();
	public $single_restriction_data = array();
	public $post_id;

	public function __construct() {
		$settings           = Settings::get();
		$this->restrictions = isset( $settings['restrictions'] ) ? $settings['restrictions'] : array();
	}

	public function the_post( $post_object ) {
		$this->post_id = $post_object->ID;
		$this->condition_manager( $post_object->ID );
	}

	public function condition( $value ) {}

	public function is_protected( $post_id = '' ) {

		if ( empty( $post_id ) || '' === $post_id ) {
			$post_id = $this->post_id;
		}

		$post_type          = get_post_type( $post_id );
		$matched_post_types = array();

		// Separating Matched Post Type
		foreach ( $this->restrictions as $key => $value ) {
			if ( $post_type === $value['post_type'] ) {
				array_push( $matched_post_types, $value );
			}
		}

		$priorities = array_column( $matched_post_types, 'priority' );
		array_multisort( $priorities, SORT_DESC, $matched_post_types );

		foreach ( $matched_post_types as $key => $value ) {

			if ( 'selected_single_items' === $value['restrict_in'] ) {

				if ( is_archive() || is_home() ) {
					return;
				}

				if ( ! $value['selected_ids'] ) {
					return false;
				}

				if ( in_array( $post_id, $value['selected_ids'] ) ) {
					$this->matched_restrictions[] = $matched_post_types[$key];

					return true;
				}

			} else {

				if ( has_term( $value['selected_ids'], $value['restrict_in'], $post_id ) ) {
					$this->matched_restrictions[] = $matched_post_types[$key];

					return true;
				} else {

					switch ( $value['restrict_in'] ) {
						case 'frontpage':
							if ( is_front_page() ) {
								$this->matched_restrictions[] = $matched_post_types[$key];

								return true;
							}
							break;

						case 'search_result':
							if ( is_search() ) {
								$this->matched_restrictions[] = $matched_post_types[$key];

								return true;
							}
							break;
						case 'error_404':
							if ( is_404() ) {
								$this->matched_restrictions[] = $matched_post_types[$key];

								return true;
							}
							break;
						case 'the_blog_index':
							if ( is_home() ) {
								$this->matched_restrictions[] = $matched_post_types[$key];

								return true;
							}
							break;
						case 'all_items':
							$this->matched_restrictions[] = $matched_post_types[$key];

							return true;
							break;

						default:
							return false;
							break;
					}
				}
			}
		}

		return false;
	}

	public function users_can_see( $role_names ) {

		if ( is_blog_admin() ) {
			return true;
		}

		if ( ! isset( $role_names ) || empty( $role_names ) ) {
			return false;
		}

		if ( in_array( 'not_logged_in', $role_names ) && ! is_user_logged_in() ) {
			return true;
		}

		$current_user = wp_get_current_user();

		foreach ( $role_names as $role ) {
			if ( in_array( $role, $current_user->roles ) ) {
				return true;
			}
		}

		return false;
	}

	public function condition_manager( $post_id ) {
		$this->is_protected( $post_id );

		foreach ( $this->matched_restrictions as $key => $value ) {
			$this->condition( $value );
		}
	}
}