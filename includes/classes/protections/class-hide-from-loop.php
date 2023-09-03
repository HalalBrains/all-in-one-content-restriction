<?php
/**
 * @author  HeyMehedi
 * @since   1.6.4
 * @version 1.6.8
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Hide_From_Loop {

	protected static $instance = null;

	public function __construct() {
		add_action( 'pre_get_posts', array( $this, 'exclude_posts' ) );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function exclude_posts( $query ) {
		if ( ! $query->is_main_query() ) {
			return;
		}

		$restrictions    = Protection_Manager::instance()->get_restrictions( 0, '', 'hide_from_loop' );
		$exclude_cats    = array();
		$exclude_tags    = array();
		$exclude_posts   = array();
		$exclude_posts   = array();
		$exclude_formats = array();

		foreach ( $restrictions as $value ) {

			if ( Protection_Manager::users_can_see( $value ) ) {
				continue;
			}

			$restrict_in  = isset( $value['restrict_in'] ) ? $value['restrict_in'] : '';
			$exclude_args = isset( $value['selected_ids'] ) ? $value['selected_ids'] : array();

			if ( 'category' == $restrict_in ) {
				$exclude_cats = array_merge( $exclude_cats, $exclude_args );
			} elseif ( 'post_tag' == $restrict_in ) {
				$exclude_tags = array_merge( $exclude_tags, $exclude_args );
			} elseif ( 'all_items' == $restrict_in ) {
				$exclude_cats = array_merge( $exclude_cats, array( 1000000000000000000000 ) );
			} elseif ( 'post_format' == $restrict_in ) {
				$exclude_formats = array_merge( $exclude_formats, $exclude_args );
			} elseif ( 'selected_single_items' == $restrict_in ) {
				$exclude_posts = array_merge( $exclude_posts, $exclude_args );
			}
		}

		$query->set( 'post__not_in', $exclude_posts );

		if ( is_archive() ) {
			$c_term_id = isset( get_queried_object()->term_id ) ? get_queried_object()->term_id : 0;
			if ( in_array( $c_term_id, $exclude_cats, ) ) {
				$query->set( 'category__not_in', $c_term_id );
			}

			if ( in_array( $c_term_id, $exclude_tags, ) ) {
				$query->set( 'tag__not_in', $c_term_id );
			}

			return;
		}

		$query->set(
			'tax_query',
			array(
				'relation' => 'OR',
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $exclude_cats,
					'operator' => 'NOT IN',
				),
				array(
					'taxonomy' => 'post_tag',
					'field'    => 'term_id',
					'terms'    => $exclude_tags,
					'operator' => 'NOT IN',
				),
				// array(
				// 	'taxonomy' => 'post_format',
				// 	'field'    => 'slug',
				// 	'terms'    => $exclude_formats,
				// ),
			)
		);
	}
}

Hide_From_Loop::instance();