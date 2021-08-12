<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Override_Contents extends Protection_Base {

	protected static $instance = null;

	public function __construct() {
		parent::__construct();
		$this->condition();
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	private function condition() {

		if ( 'override_contents' !== $this->settings['protection_type'] || ! isset( $this->settings['protection_type'] ) ) {
			return;
		}

		add_filter( 'the_title', array( $this, 'the_title' ), 10, 2 );
		add_filter( 'the_content', array( $this, 'the_content' ) );
		add_filter( 'get_the_excerpt', array( $this, 'the_excerpt' ), 11, 2 );
	}

	public function the_title( $title, $id ) {
		if ( $this->settings['the_title'] ) {
			return $this->show_content( $title, $id, Helper::add_suffix_prefix( '%%title%%', $title, $this->settings['the_title'] ) );
		}

		return $title;
	}

	public function the_excerpt( $the_excerpt, $post ) {

		if ( $this->settings['the_excerpt'] ) {
			return $this->show_content( $the_excerpt, $post->ID, Helper::add_suffix_prefix( '%%excerpt%%', $the_excerpt, $this->settings['the_excerpt'] ) );
		}

		return $the_excerpt;
	}

	public function the_content( $the_content ) {
		if ( $this->settings['the_content'] ) {
			return $this->show_content( $the_content, get_the_ID(), Helper::add_suffix_prefix( '%%content%%', $the_content, $this->settings['the_content'] ) );
		}

		return $the_content;
	}

	private function show_content( $content, $post_id, $modified_content ) {

		if ( $this->users_can_see() ) {
			return $content;
		}

		if ( $this->is_protected( $post_id ) ) {
			return $modified_content;
		}

		return $content;
	}
}

Override_Contents::instance();