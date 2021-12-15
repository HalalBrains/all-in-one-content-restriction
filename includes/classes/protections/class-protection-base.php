<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.3
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

	// check is post item is protected or not?
	public function is_protected( $post_id = '' ) {

		if ( empty( $post_id ) || '' === $post_id ) {
			$post_id = $this->post_id;
		}

		// Get Post Type for @post_id
		$post_type = get_post_type( $post_id );
		// Separating Matched Post Types
		$matched_post_types = array();
		foreach ( $this->restrictions as $key => $value ) {
			if ( $post_type === $value['post_type'] ) {
				array_push( $matched_post_types, $value );
			}
		}

		// Sort by priorities @SORT_DESC
		$priorities = array_column( $matched_post_types, 'priority' );
		array_multisort( $priorities, SORT_DESC, $matched_post_types );

		foreach ( $matched_post_types as $key => $value ) {

			// Excute Only for Single Post Item
			if ( 'selected_single_items' === $value['restrict_in'] ) {

				// check if it's a archive or blog, don't redirect it.
				if ( is_archive() || is_home() ) {
					if ( isset( $value['protection_type'] ) && ( 'login_and_back' === $value['protection_type'] || 'redirect' === $value['protection_type'] ) ) {
						return;
					}
				}

				if ( ! $value['selected_ids'] ) {
					return false;
				}

				if ( in_array( $post_id, $value['selected_ids'] ) ) {
					$this->matched_restrictions[] = $matched_post_types[$key];

					return true;
				}

				// Else, execute with taxonomy and others.
			} else {

				// check if post go with taxonomy terms
				if ( has_term( $value['selected_ids'], $value['restrict_in'], $post_id ) ) {
					$this->matched_restrictions[] = $matched_post_types[$key];

					return true;

					// else check these predefined cases
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

	// Selected user can see the content...
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