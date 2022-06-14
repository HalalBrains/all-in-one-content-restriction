<?php
/**
 * @author  HeyMehedi
 * @since   1.4
 * @version 1.4
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Blur extends Protection_Base {

	protected static $instance      = null;
	public $single_restriction_data = array();

	public function __construct() {
		parent::__construct();
		add_action( 'the_post', array( $this, 'the_post' ) );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function condition( $value ) {

		$this->single_restriction_data = $value;

		if ( 'blur' != $value['protection_type'] ) {
			return;
		}
		$this->single_restriction_data['blur_apply_to'] = isset( $this->single_restriction_data['blur_apply_to'] ) ? $this->single_restriction_data['blur_apply_to'] : array();
		add_filter( 'the_title', array( $this, 'the_title' ), 10, 2 );
		add_filter( 'the_content', array( $this, 'the_content' ) );
		add_filter( 'get_the_excerpt', array( $this, 'the_excerpt' ), 11, 2 );
	}

	public function the_title( $title, $post_id ) {

		if ( in_array( 'the_title', $this->single_restriction_data['blur_apply_to'] ) ) {
			return $this->add_blur_class( $title, $post_id, $this->single_restriction_data );
		}

		return $title;
	}

	public function the_excerpt( $the_excerpt, $post ) {

		if ( in_array( 'the_excerpt', $this->single_restriction_data['blur_apply_to'] ) ) {
			return $this->add_blur_class( $the_excerpt, $post->ID, $this->single_restriction_data );
		}

		return $the_excerpt;
	}

	public function the_content( $the_content ) {

		if ( in_array( 'the_content', $this->single_restriction_data['blur_apply_to'] ) ) {
			return $this->add_blur_class( $the_content, get_the_ID(), $this->single_restriction_data, 'div' );
		}

		return $the_content;
	}

	private function add_blur_class( $content, $post_id, $single_restriction_data, $html_tag = 'span' ) {

		if ( $this->users_can_see( $single_restriction_data ) ) {
			return $content;
		}

		if ( $this->is_protected( $post_id ) ) {

			$add_rand_text = apply_filters( 'all_in_one_blur_protection_rand_text', true );
			if ( $add_rand_text ) {
				$content = Helper::get_random_text( $content );
			}

			$blur_level = isset( $single_restriction_data['blur_level'] ) ? $single_restriction_data['blur_level'] : 10;
			$spread     = isset( $single_restriction_data['spread'] ) ? $single_restriction_data['spread'] : 10;

			return sprintf( '<%s class="aiocr-blur" style="-webkit-filter: blur(%spx); text-shadow: 0 0 %spx #000;">%s</%s>', $html_tag, esc_attr( $blur_level ), esc_attr( $spread ), $content, $html_tag );
		}

		return $content;
	}
}

Blur::instance();