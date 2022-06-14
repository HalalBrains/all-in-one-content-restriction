<?php
/**
 * @author  HeyMehedi
 * @since   1.5
 * @version 1.5
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Hide_From_Loop extends Protection_Base {

	protected static $instance      = null;
	public $single_restriction_data = array();
	public $exclude_args            = array();

	public function __construct() {
		parent::__construct();
		add_action( 'the_post', array( $this, 'the_post' ) );
		add_action( 'pre_get_posts', array( $this, 'exclude_posts' ) );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function condition( $value ) {

		$this->single_restriction_data = $value;

		$this->exclude_args = 1;
	}

	public function exclude_posts( $query ) {

		foreach ( $this->restrictions as $value ) {
			$this->single_restriction_data = $value;
			if ( 'hide_from_loop' != $this->single_restriction_data['protection_type'] ) {
				return;
			}

			if ( $this->users_can_see( $this->single_restriction_data ) ) {
				return;
			}

			// if ( ! $this->is_protected() ) {
			// 	return;
			// }

			$restrict_in  = isset( $this->single_restriction_data['restrict_in'] ) ? $this->single_restriction_data['restrict_in'] : '';
			$exclude_args = isset( $this->single_restriction_data['selected_ids'] ) ? $this->single_restriction_data['selected_ids'] : array();

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