<?php
/**
 * @author  HeyMehedi
 * @since   1.0.0
 * @version 1.6.7
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

use HeyMehedi\All_In_One_Content_Restriction\Settings;

class Protection_Manager {

	protected static $instance = null;
	public $is_protected       = false;
	public $restrictions       = array();

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

	public function get_restrictions_by_post_type( $post_type, array $restrictions = array() ) {
		if ( ! $restrictions ) {
			$restrictions = $this->restrictions;
		}

		$return = array();
		foreach ( $restrictions as $key => $value ) {
			$val = isset( $value['post_type'] ) ? $value['post_type'] : '';
			if ( $post_type === $val ) {
				array_push( $return, $value );
			}
		}

		return $return;
	}

	public function get_restrictions_by_post_id( $post_id, array $restrictions = array() ) {
		if ( ! $restrictions ) {
			$restrictions = $this->restrictions;
		}

		if ( empty( $post_id ) || '' === $post_id ) {
			$post_id = get_the_ID();
		}

		$return = array();

		foreach ( $restrictions as $key => $value ) {

			if ( 'selected_single_items' === $value['restrict_in'] ) {

				if ( ! $value['selected_ids'] ) {
					continue;
				}

				if ( in_array( $post_id, $value['selected_ids'] ) ) {
					$return[]           = $restrictions[$key];
					$this->is_protected = true;
					continue;
				}

			} else {

				/* check if post go with taxonomy terms */
				if ( has_term( $value['selected_ids'], $value['restrict_in'], $post_id ) ) {
					$return[]           = $restrictions[$key];
					$this->is_protected = true;
					continue;
				} else {

					/* else check these predefined cases */
					switch ( $value['restrict_in'] ) {
						case 'frontpage':
							if ( is_front_page() ) {
								$return[]           = $restrictions[$key];
								$this->is_protected = true;
								continue 2;
							}
							break;

						case 'search_result':
							if ( is_search() ) {
								$return[]           = $restrictions[$key];
								$this->is_protected = true;
								continue 2;
							}
							break;

						case 'error_404':
							if ( is_404() ) {
								$return[]           = $restrictions[$key];
								$this->is_protected = true;
								continue 2;
							}
							break;

						case 'the_blog_index':
							if ( is_home() ) {
								$return[]           = $restrictions[$key];
								$this->is_protected = true;
								continue 2;
							}
							break;

						case 'all_items':
							$return[]           = $restrictions[$key];
							$this->is_protected = true;
							continue 2;
							break;

						default:
							$this->is_protected = false;
							continue 2;
							break;
					}
				}
			}
		}

		return $return;
	}

	public function get_restrictions_by_protection( $protection_type, array $restrictions = array() ) {
		if ( ! $restrictions ) {
			$restrictions = $this->restrictions;
		}

		$return = array();
		foreach ( $restrictions as $key => $value ) {
			$val = isset( $value['protection_type'] ) ? $value['protection_type'] : '';
			if ( $protection_type === $val ) {
				array_push( $return, $value );
			}
		}

		return $return;
	}

	public function sort( array $restrictions, $order = 'asc' ) {
		if ( 'asc' == $order ) {
			$priorities = array_column( $restrictions, 'priority' );
			array_multisort( $priorities, SORT_ASC, $restrictions );
		} else {
			$priorities = array_column( $restrictions, 'priority' );
			array_multisort( $priorities, SORT_DESC, $restrictions );
		}

		return $restrictions;
	}

	/**
	 * Retrieves restrictions by post_id, post_type, or protection_type
	 *
	 * @param int 	 $post_id  Optional.
	 * @param string $post_type  Optional.
	 * @param string $protection_type  Optional.
	 * @param bool	 $single_return  Optional.
	 * @param string $sort  Optional.
	 *
	 * @return array if post have restriction
	 */
	public function get_restrictions( $post_id = 0, $post_type = '', $protection_type = '', $single_return = false, $order = 'desc' ) {

		$restrictions = $this->restrictions;

		if ( $post_id ) {
			$restrictions = $this->get_restrictions_by_post_id( $post_id, $restrictions );
		}

		if ( $post_type ) {
			$restrictions = $this->get_restrictions_by_post_type( $post_type, $restrictions );
		}

		if ( $protection_type ) {
			$restrictions = $this->get_restrictions_by_protection( $protection_type, $restrictions );
		}

		if ( 'asc' == $order ) {
			$restrictions = $this->sort( $restrictions, 'asc' );
		} else {
			$restrictions = $this->sort( $restrictions, 'desc' );
		}

		if ( $single_return ) {
			return isset( $restrictions[0] ) ? $restrictions[0] : array();
		}

		return $restrictions;
	}

	/**
	 * Whether the current post is restricted.
	 *
	 * @param int $post_id  Optional.
	 * @return bool if post protected
	 */
	public static function is_protected( $post_id = 0 ) {
		if ( empty( self::instance()->is_protected ) && $post_id ) {
			self::$instance->get_restrictions( $post_id );
		}

		return self::instance()->is_protected;
	}

	/**
	 * Check if current user has access to the item
	 *
	 * @param array $restriction
	 * @return bool if user has access
	 */
	public static function users_can_see( $restriction ) {

		$current_user = wp_get_current_user();

		if ( is_blog_admin() || is_admin() || user_can( $current_user->ID, 'edit_posts' ) ) {
			return true;
		}

		$user_restriction_type = isset( $restriction['user_restriction_type'] ) ? $restriction['user_restriction_type'] : 'role_names';
		$role_names            = isset( $restriction['role_names'] ) ? $restriction['role_names'] : array();
		$specify_users         = isset( $restriction['specify_users'] ) ? $restriction['specify_users'] : array();

		if ( 'role_names' == $user_restriction_type || 'roles' == $user_restriction_type ) {

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