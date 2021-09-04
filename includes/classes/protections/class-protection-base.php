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

	public function __construct() {
		$settings           = Settings::get();
		$this->restrictions = $settings['restrictions'];

		$this->is_protected( '' );
	}

	public function is_protected( $post_id = 217 ) {

		if ( empty( $post_id ) ) {
			return;
		}

		$post_type         = get_post_type( $post_id );
		$matched_post_type = array();

		// Separating Matched Post Type
		foreach ( $this->restrictions as $key => $value ) {
			if ( $post_type === $value['post_type'] ) {
				array_push( $matched_post_type, $value );
			}
		}

		$priorities = array_column( $matched_post_type, 'priority' );
		array_multisort( $priorities, SORT_DESC, $matched_post_type );

		return;

		foreach ( $matched_post_type as $key => $value ) {

			if ( 'selected_single_items' === $value['restrict_in'] ) {
				if ( ! $value['selected_ids'] ) {
					return false;
				}

				if ( in_array( $post_id, $value['selected_ids'] ) ) {
					return true;
				}

			} else {

				if ( has_term( $value['selected_ids'], $value['restrict_in'], $post_id ) ) {
					return true;
				} else {

					switch ( $value['restrict_in'] ) {
						case 'frontpage':
							if ( is_front_page() ) {
								return true;
							}
							break;

						case 'search_result':
							if ( is_search() ) {
								return true;
							}
							break;
						case 'error_404':
							if ( is_404() ) {
								return true;
							}
							break;
						case 'the_blog_index':
							if ( is_home() ) {
								return true;
							}
							break;
						case 'all_items':
							return true;
							break;

						default:
							return false;
							break;
					}
				}
			}
		}

		// if ( 'category' === $this->settings['restrict_in'] ) {
		// 	if ( ! $this->settings['category_ids'] ) {
		// 		return false;
		// 	}
		// 	if ( has_category( $this->settings['category_ids'], $post_id ) ) {
		// 		return true;
		// 	}
		// }

		return false;
	}

	public function users_can_see() {

		if ( is_blog_admin() ) {
			return true;
		}

		if ( ! isset( $this->restrictions['role_names'] ) || empty( $this->settings['role_names'] ) ) {
			return false;
		}

		if ( in_array( 'not_logged_in', $this->settings['role_names'] ) && ! is_user_logged_in() ) {
			return true;
		}

		$current_user = wp_get_current_user();

		foreach ( $this->settings['role_names'] as $role ) {
			if ( in_array( $role, $current_user->roles ) ) {
				return true;
			}
		}

		return false;
	}
}