<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.6
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

use HeyMehedi\All_In_One_Content_Restriction\Settings;

class Protection_Manager {

	protected static $instance = null;
	public $is_protected;

	public function __construct() {
		$settings           = Settings::get();
		$this->restrictions = isset( $settings['restrictions'] ) ? $settings['restrictions'] : array();
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Protect by respected protection_type
	 *
	 * @param string $single_restriction_data
	 * @return void
	 */
	public function condition_manager( $post_object ) {
		$post_id              = $post_object->ID ? $post_object->ID : get_the_ID();
		$matched_restrictions = $this->get_matched_restrictions( $post_id );

		if ( ! $this->is_protected ) {
			return;
		}

		foreach ( $matched_restrictions as $key => $single_restriction_data ) {
			$protection_type = isset( $single_restriction_data['protection_type'] ) ? $single_restriction_data['protection_type'] : '';

			switch ( $protection_type ) {
				case 'redirect':
					new Redirection( $single_restriction_data, $this );
					break;

				case 'blur':
					new Blur( $single_restriction_data, $this );
					break;
				case 'hide_from_loop':
					new Hide_From_Loop( $single_restriction_data, $this );
					break;
				case 'login_and_back':
					new Login_And_Back( $single_restriction_data, $this );
					break;
				case 'obfuscate':
					new Obfuscate( $single_restriction_data, $this );
					break;
				case 'override_contents':
					new Override_Contents( $single_restriction_data, $this );
					break;
			}
		}
	}

	/**
	 * Retrieves matched restrictions if the current post is restricted.
	 *
	 * @param string $post_id  Optional.
	 * @return array if post have restrction
	 */
	public static function get_matched_restrictions( $post_id = '' ) {

		if ( empty( $post_id ) || '' === $post_id ) {
			$post_id = get_the_ID();
		}

		// Get Post Type by post_id
		$post_type            = get_post_type( $post_id );
		$matched_post_types   = array();
		$matched_restrictions = array();

		// Separating Matched Post Types
		foreach ( self::$instance->restrictions as $key => $value ) {
			$val = isset( $value['post_type'] ) ? $value['post_type'] : '';
			if ( $post_type === $val ) {
				array_push( $matched_post_types, $value );
			}
		}

		// Sort by priorities @SORT_DESC
		$priorities = array_column( $matched_post_types, 'priority' );
		array_multisort( $priorities, SORT_DESC, $matched_post_types );

		foreach ( $matched_post_types as $key => $value ) {

			// Excute Only for Single Post Items
			if ( 'selected_single_items' === $value['restrict_in'] ) {

				if ( ! $value['selected_ids'] ) {
					continue;
				}

				if ( in_array( $post_id, $value['selected_ids'] ) ) {
					$matched_restrictions[]       = $matched_post_types[$key];
					self::$instance->is_protected = true;
					continue;
				}

				// Else, execute with taxonomy and others.
			} else {

				// Check if post go with taxonomy terms
				if ( has_term( $value['selected_ids'], $value['restrict_in'], $post_id ) ) {
					$matched_restrictions[]       = $matched_post_types[$key];
					self::$instance->is_protected = true;
					continue;
					// else check these predefined cases
				} else {

					switch ( $value['restrict_in'] ) {
						case 'frontpage':
							if ( is_front_page() ) {
								$matched_restrictions[]       = $matched_post_types[$key];
								self::$instance->is_protected = true;
								continue 2;
							}
							break;

						case 'search_result':
							if ( is_search() ) {
								$matched_restrictions[]       = $matched_post_types[$key];
								self::$instance->is_protected = true;
								continue 2;
							}
							break;

						case 'error_404':
							if ( is_404() ) {
								$matched_restrictions[]       = $matched_post_types[$key];
								self::$instance->is_protected = true;
								continue 2;
							}
							break;

						case 'the_blog_index':
							if ( is_home() ) {
								$matched_restrictions[]       = $matched_post_types[$key];
								self::$instance->is_protected = true;
								continue 2;
							}
							break;

						case 'all_items':
							$matched_restrictions[]       = $matched_post_types[$key];
							self::$instance->is_protected = true;
							continue 2;
							break;

						default:
							self::$instance->is_protected = false;
							continue 2;
							break;
					}
				}
			}
		}

		$return_single_restrction_by_top_piority[0] = isset( $matched_restrictions[0] ) ? $matched_restrictions[0] : array();

		return $return_single_restrction_by_top_piority;
	}

	/**
	 * Whether the current post is restricted.
	 *
	 * @param string $post_id  Optional.
	 * @return bool if post have restrction : true
	 */
	public static function is_protected( $post_id = '' ) {
		if ( empty( self::$instance->is_protected ) && $post_id ) {
			self::$instance->get_matched_restrictions( $post_id );
		}

		return self::$instance->is_protected;
	}

	/**
	 * Check if current user can see restricted item
	 *
	 * @param string $single_restriction_data
	 * @return bool if user has access : true
	 */
	public static function users_can_see( $single_restriction_data ) {

		if ( is_blog_admin() ) {
			return true;
		}

		$user_restriction_type = isset( $single_restriction_data['user_restriction_type'] ) ? $single_restriction_data['user_restriction_type'] : 'role_names';
		$role_names            = isset( $single_restriction_data['role_names'] ) ? $single_restriction_data['role_names'] : array();
		$specify_users         = isset( $single_restriction_data['specify_users'] ) ? $single_restriction_data['specify_users'] : array();
		$current_user          = wp_get_current_user();

		if ( 'role_names' == $user_restriction_type ) {
			if ( ! isset( $role_names ) || empty( $role_names ) ) {
				return false;
			}

			if ( in_array( 'not_logged_in', $role_names ) && ! is_user_logged_in() ) {
				return true;
			}

			foreach ( $role_names as $role ) {
				if ( in_array( $role, $current_user->roles ) ) {
					return true;
				}
			}
		} elseif ( 'specify_users' == $user_restriction_type ) {
			if ( in_array( $current_user->user_login, $specify_users ) ) {
				return true;
			}
		}

		return false;
	}
}