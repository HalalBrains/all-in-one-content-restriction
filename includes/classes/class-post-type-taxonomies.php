<?php
/**
 * @author  HeyMehedi
 * @since   1.1.0
 * @version 1.6.4
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Post_Type_Taxonomies {

	public static $instance;
	public $preload_posts = false;
	public $conditions;
	public $condition_sort_order = array();

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public static function get_post_types_options( $selected_post_type_key = 'post' ) {
		$post_types = json_decode( json_encode( Query::get_post_types() ), true );

		return Markup_Manager::create_html_options( $post_types, $selected_post_type_key );
	}

	public static function get_restrict_in_options( $post_type_key = 'post', $selected_restrict_in = 'category', $markup = true ) {
		$obj = get_post_type_object( $post_type_key );

		$taxonomies = json_decode( json_encode( Query::get_taxonomies( $post_type_key ) ), true );

		foreach ( $taxonomies as $key => $value ) {
			$taxonomies[$key]['label'] = sprintf( "Selected %s's %s", ucwords( $value['label'] ), ucwords( $obj->labels->singular_name ) );
		}

		$taxonomies['all_items'] = array(
			'label' => sprintf( "All %s", ucwords( $obj->labels->name ) ),
		);
		$taxonomies['selected_single_items'] = array(
			'label' => sprintf( "Selected %s", ucwords( $obj->labels->singular_name ) ),
		);

		if ( 'page' === $post_type_key ) {
			$taxonomies = self::create_page_restrict_in_extra( $taxonomies );
		}

		if ( 'post' === $post_type_key ) {
			$taxonomies = self::create_post_restrict_in_extra( $taxonomies );
			unset( $taxonomies['post_format'] );
		}
		if ( ! $markup ) {
			return $taxonomies;
		}

		return Markup_Manager::create_html_options( apply_filters( 'all_in_one_content_restriction_taxonomies', $taxonomies ), $selected_restrict_in );
	}

	public static function has_custom_restrict_in( $restriction_in ) {
		$custom_restrict_in = array(
			'frontpage',
			'the_blog_index',
			'all_items',
		);

		return in_array( $restriction_in, $custom_restrict_in );
	}

	private static function create_page_restrict_in_extra( $taxonomies ) {
		$custom_restrict_in = array(
			'frontpage'     => array(
				'label' => esc_attr__( 'Homepage / Frontpage', 'all-in-one-content-restriction' ),
			),
		);

		return array_merge( $custom_restrict_in, $taxonomies );
	}

	private static function create_post_restrict_in_extra( $taxonomies ) {
		$custom_restrict_in = array(
			'the_blog_index' => array(
				'label' => esc_attr__( 'Blog Index', 'all-in-one-content-restriction' ),
			),
		);

		return array_merge( $custom_restrict_in, $taxonomies );
	}

}