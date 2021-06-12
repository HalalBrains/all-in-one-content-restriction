<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Content_Restriction;

class Query {

	public static function get_registered_post_types() {
		global $wp_post_types;

		return array_keys( $wp_post_types );
	}

	public function get_role_names() {

		global $wp_roles;

		if ( ! isset( $wp_roles ) ) {
			$wp_roles = new \WP_Roles();
		}

		return $wp_roles->get_names();
	}

	public static function pre_get_posts() {

		$categories           = get_categories();
		$hide_content_cat_ids = array();

		foreach ( $categories as $key => $value ) {
			$cat_id   = $categories[$key]->term_id;
			$cat_data = get_option( "taxonomy_$cat_id" );

			if ( $cat_data['show_content'] == 'yes' ) {
				array_push( $hide_content_cat_ids, $cat_id );
			}
		}

		return $hide_content_cat_ids;
	}

}