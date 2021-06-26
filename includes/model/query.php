<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Content_Restriction;

class Query {

	// public function __construct() {
	// 	add_action( 'pre_get_posts', array( $this, 'pre_get_posts' ), 10 );
	// }

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

	// public static function pre_get_posts() {

	// 	$categories           = get_categories();
	// 	$hide_content_cat_ids = array();

	// 	foreach ( $categories as $key => $value ) {
	// 		$cat_id   = $categories[$key]->term_id;
	// 		$cat_data = get_option( "taxonomy_$cat_id" );

	// 		if ( $cat_data['show_content'] == 'yes' ) {
	// 			array_push( $hide_content_cat_ids, $cat_id );
	// 		}
	// 	}

	// 	return $hide_content_cat_ids;
	// }

}