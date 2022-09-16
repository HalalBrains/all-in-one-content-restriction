<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.6.2
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Query {

	public static function get_role_names() {

		global $wp_roles;

		if ( ! isset( $wp_roles ) ) {
			$wp_roles = new \WP_Roles();
		}
		$role_names                  = $wp_roles->get_names();
		$role_names['not_logged_in'] = __( 'Not logged in', 'all-in-one-content-restriction' );

		return $role_names;
	}

	public static function get_users() {
		$users = get_users( array( 'fields' => array( 'display_name', 'user_login' ) ) );

		return $users;
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

	public static function get_posts( $post_type = 'post', $exclude_ids = array(), $include_ids = array() ) {

		$args = array( 'fields' => 'ids', 'numberposts' => -1 );

		if ( ! empty( $exclude_ids ) ) {
			$args['exclude'] = $exclude_ids;
		}

		if ( ! empty( $include_ids ) ) {
			$args['include'] = $include_ids;
		}

		$args['post_type'] = $post_type;

		$posts = get_posts( $args );

		return $posts;
	}

	public static function get_post_types() {

		// return get_post_types( array( 'public' => true ), 'objects' ); @will use it in the future to work with all the post types.
		$post_types = array(
			'post' => array(
				'label' => esc_html__( 'Posts', 'all-in-one-content-restriction' ),
			),
			'page' => array(
				'label' => esc_html__( 'Pages', 'all-in-one-content-restriction' ),
			),
		);

		return $post_types;
	}

	public static function get_taxonomies( $post_type_key ) {
		return get_object_taxonomies( $post_type_key, 'object' );
	}

	public static function get_terms( $taxonomy, $exclude_ids = array(), $include_ids = array() ) {

		$args = array(
			'taxonomy'   => $taxonomy,
			'hide_empty' => false,
		);

		if ( $exclude_ids ) {
			$args['exclude'] = $exclude_ids;
		}

		if ( $include_ids ) {
			$args['include'] = $include_ids;
		}

		return get_terms( $args );
	}
}