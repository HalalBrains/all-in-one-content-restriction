<?php
/**
 * @author  HeyMehedi
 * @since   1.1
 * @version 1.0
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

	public static function get_restriction_in_options( $post_type_key = 'post', $selected_restrict_in = 'category' ) {
		$taxonomies = json_decode( json_encode( Query::get_taxonomies( $post_type_key ) ), true );
		$obj        = get_post_type_object( $post_type_key );

		foreach ( $taxonomies as $key => $value ) {
			$taxonomies[$key]['label'] = sprintf( "Any '%s' has selected '%s'", ucwords( $obj->labels->singular_name ), ucwords( $value['label'] ) );
		}

		if ( 'page' === $post_type_key ) {
			$taxonomies = self::create_page_restrict_in_extra( $taxonomies );
		}

		if ( 'post' === $post_type_key ) {
			$taxonomies = self::create_post_restrict_in_extra( $taxonomies );
		}

		return Markup_Manager::create_html_options( $taxonomies, $selected_restrict_in );
	}

	private static function create_page_restrict_in_extra( $taxonomies ) {
		
		$custom_restriction_in = array(
			'frontpage'     => array(
				'label' => 'The Home Page',
			),
			'search_result' => array(
				'label' => 'A Search Result Page',
			),
			'error_404'     => array(
				'label' => '404 Error page',
			),
		);

		return array_merge( $custom_restriction_in, $taxonomies );
	}

	private static function create_post_restrict_in_extra( $taxonomies ) {
		$custom_restriction_in = array(
			'frontpage' => array(
				'label' => 'Homepage',
			),
			'error_404' => array(
				'label' => 'Error 404 page',
			),
		);

		return array_merge( $custom_restriction_in, $taxonomies );
	}

}