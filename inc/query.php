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

	public static function get_categories() {

		$cat_list_html = '';

		$term_query = new \WP_Term_Query(
			array(
				'taxonomy'   => 'category', // <-- Custom Taxonomy name..
				'orderby' => 'name',
				'order'      => 'ASC',
				'fields'     => 'id=>name',
				'hide_empty' => false,
			),
		);

		if ( ! $term_query->terms ) {
			return;
		}

		foreach ( $term_query->terms as $id => $name ) {
			$cat_list_html .= sprintf( '<tr data-item-id="%s"><td><div class="wp-menu-image dashicons-before dashicons-plus-alt2" aria-hidden="true"></div></td><td id="item-id">%s</td><td>%s</td></tr>', $id, $id, $name );
			// $cat_list_html .= sprintf( '<option value="%s"> %s </option>', $id, $name );
		}

		echo $cat_list_html;

	}

	public static function get_posts() {
		$args  = array( 'fields' => 'ids' );
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