<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

use HeyMehedi\All_In_One_Content_Restriction\Settings;

class Protection_Base {

	public $settings;

	public function __construct() {
		$this->settings = Settings::get();
	}

	public function is_protected( $post_id ) {

		if ( 'category' === $this->settings['restrict_in'] ) {
			if ( ! $this->settings['category_ids'] ) {
				return false;
			}
			if ( has_category( $this->settings['category_ids'], $post_id ) ) {
				return true;
			}
		}

		if ( 'single_post' === $this->settings['restrict_in'] ) {
			if ( ! $this->settings['single_post_ids'] ) {
				return false;
			}
			if ( in_array( $post_id, $this->settings['single_post_ids'] ) ) {
				return true;
			}
		}

		return false;
	}

	public function users_can_see() {

		if ( is_blog_admin() ) {
			return true;
		}

		if ( ! isset( $this->settings['role_names'] ) || empty( $this->settings['role_names'] ) ) {
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