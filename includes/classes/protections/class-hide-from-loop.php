<?php
/**
 * @author  HeyMehedi
 * @since   1.6.4
 * @version 1.6.4
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
		$restrictions = Protection_Manager::instance()->get_restrictions( 0, '', 'hide_from_loop' );

		foreach ( $restrictions as $value ) {

			if ( Protection_Manager::users_can_see( $value ) ) {
				return;
			}

			$restrict_in  = isset( $value['restrict_in'] ) ? $value['restrict_in'] : '';
			$exclude_args = isset( $value['selected_ids'] ) ? $value['selected_ids'] : array();

			if ( 'category' == $restrict_in ) {
				$not_in = 'category__not_in';
			} elseif ( 'post_tag' == $restrict_in ) {
				$not_in = 'tag__not_in';
			} elseif ( 'all_items' == $restrict_in ) {
				$not_in = '______________';
			} elseif ( 'post_format' == $restrict_in ) {
				$not_in = '______________';
			} elseif ( 'selected_single_items' == $restrict_in ) {
				$not_in = 'post__not_in';
			}
		}

		$query->set( $not_in, $exclude_args );
	}
}

Hide_From_Loop::instance();