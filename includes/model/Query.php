<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\AIO_Content_Restriction;

class Query {

	public static function get_registered_post_types() {
		global $wp_post_types;

		return array_keys( $wp_post_types );
	}

	public static function get_role_names() {

		global $wp_roles;

		if ( ! isset( $wp_roles ) ) {
			$wp_roles = new \WP_Roles();
		}
		$role_names                  = $wp_roles->get_names();
		$role_names['not_logged_in'] = __( 'Not logged in', 'aio-content-restriction' );

		return $role_names;
	}

	public static function get_categories( $exclude_ids = array(), $include_ids = array() ) {

		$args = array(
			'taxonomy'   => 'category',
			'orderby'    => 'name',
			'order'      => 'ASC',
			'fields'     => 'id=>name',
			'hide_empty' => false,
		);

		if ( ! empty( $exclude_ids ) ) {
			$args['exclude'] = $exclude_ids;
		}

		if ( ! empty( $include_ids ) ) {
			$args['include'] = $include_ids;
		}

		$term_query = new \WP_Term_Query( $args );

		if ( ! $term_query->terms ) {
			return;
		}

		return $term_query;
	}

	public static function get_posts( $exclude_ids = array(), $include_ids = array() ) {

		$args = array( 'fields' => 'ids', 'numberposts' => -1 );

		if ( ! empty( $exclude_ids ) ) {
			$args['exclude'] = $exclude_ids;
		}

		if ( ! empty( $include_ids ) ) {
			$args['include'] = $include_ids;
		}

		$posts = get_posts( $args );

		return $posts;
	}

}