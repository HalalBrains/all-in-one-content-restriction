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

		add_filter( 'the_title', array( $this, 'the_title' ), 10, 2 );
		add_filter( 'the_content', array( $this, 'the_content' ) );
		add_filter( 'get_the_excerpt', array( $this, 'the_excerpt' ), 11, 2 );
	}

	public function the_title( $title, $post_id ) {

		if ( $this->single_restriction_data['the_title'] ) {
			return $this->add_blur_class( $title, $post_id, $this->single_restriction_data );
		}

		return $title;
	}

	public function the_excerpt( $the_excerpt, $post ) {

		if ( $this->single_restriction_data['the_excerpt'] ) {
			return $this->add_blur_class( $the_excerpt, $post->ID, $this->single_restriction_data );
		}

		return $the_excerpt;
	}

	public function the_content( $the_content ) {

		if ( $this->single_restriction_data['the_content'] ) {
			return $this->add_blur_class( $the_content, get_the_ID(), $this->single_restriction_data, 'div' );
		}

		return $the_content;
	}

	private function add_blur_class( $content, $post_id, $single_restriction_data, $html_tag = 'span' ) {

		if ( $this->users_can_see( $single_restriction_data['role_names'] ) ) {
			return $content;
		}

		if ( $this->is_protected( $post_id ) ) {
			return sprintf( '<%s class="aiocr-blur">%s</%s>', $html_tag, Helper::get_random_text( $content ), $html_tag );
		}

		return $content;
	}
}

Blur::instance();