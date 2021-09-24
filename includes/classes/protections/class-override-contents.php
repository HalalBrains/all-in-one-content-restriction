<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.1
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Override_Contents extends Protection_Base {

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

		if ( 'override_contents' != $value['protection_type'] ) {
			return;
		}

		add_filter( 'the_title', array( $this, 'the_title' ), 10, 2 );
		add_filter( 'the_content', array( $this, 'the_content' ) );
		add_filter( 'get_the_excerpt', array( $this, 'the_excerpt' ), 11, 2 );
	}

	public function the_title( $title, $post_id ) {

		if ( $this->single_restriction_data['the_title'] ) {
			return $this->show_content( $title, $post_id, Helper::add_suffix_prefix( '%%title%%', $title, $this->single_restriction_data['the_title'] ), $this->single_restriction_data );
		}

		return $title;
	}

	public function the_excerpt( $the_excerpt, $post ) {

		if ( $this->single_restriction_data['the_excerpt'] ) {
			return $this->show_content( $the_excerpt, $post->ID, Helper::add_suffix_prefix( '%%excerpt%%', $the_excerpt, $this->single_restriction_data['the_excerpt'] ), $this->single_restriction_data );
		}

		return $the_excerpt;
	}

	public function the_content( $the_content ) {

		if ( $this->single_restriction_data['the_content'] ) {
			return $this->show_content( $the_content, get_the_ID(), Helper::add_suffix_prefix( '%%content%%', $the_content, $this->single_restriction_data['the_content'] ), $this->single_restriction_data );
		}

		return $the_content;
	}

	private function show_content( $content, $post_id, $modified_content, $single_restriction_data ) {

		if ( $this->users_can_see( $single_restriction_data['role_names'] ) ) {
			return $content;
		}

		if ( $this->is_protected( $post_id ) ) {
			return $modified_content;
		}

		return $content;
	}
}

Override_Contents::instance();