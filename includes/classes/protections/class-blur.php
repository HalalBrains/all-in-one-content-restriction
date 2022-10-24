<?php
/**
 * @author  HeyMehedi
 * @since   1.4
 * @version 1.6.4
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Blur {

	public $restrictions = array();

	public function __construct() {
		add_filter( 'the_title', array( $this, 'the_title' ), 10, 2 );
		add_filter( 'the_content', array( $this, 'the_content' ) );
		add_filter( 'get_the_excerpt', array( $this, 'the_excerpt' ), 11, 2 );
	}

	public function the_title( $title, $post_id ) {

		$this->restrictions = Protection_Manager::instance()->get_restrictions( $post_id, '', 'blur' );

		foreach ( $this->restrictions as $key => $restriction ) {
			$blur_apply_to = isset( $restriction['blur_apply_to'] ) ? $restriction['blur_apply_to'] : array();
			if ( in_array( 'the_title', $blur_apply_to ) ) {
				$title = $this->add_blur_class( $title, $restriction );
			}
		}

		return $title;
	}

	public function the_excerpt( $the_excerpt, $post ) {

		foreach ( $this->restrictions as $key => $restriction ) {
			$blur_apply_to = isset( $restriction['blur_apply_to'] ) ? $restriction['blur_apply_to'] : array();
			if ( in_array( 'the_excerpt', $blur_apply_to ) ) {
				$the_excerpt = $this->add_blur_class( $the_excerpt, $restriction );
			}
		}

		return $the_excerpt;
	}

	public function the_content( $the_content ) {

		foreach ( $this->restrictions as $key => $restriction ) {
			$blur_apply_to = isset( $restriction['blur_apply_to'] ) ? $restriction['blur_apply_to'] : array();
			if ( in_array( 'the_content', $blur_apply_to ) ) {
				$the_content = $this->add_blur_class( $the_content, $restriction, 'div' );
			}
		}

		return $the_content;
	}

	private function add_blur_class( $content, $restriction, $html_tag = 'span' ) {

		if ( Protection_Manager::users_can_see( $restriction ) ) {
			return $content;
		}

		if ( Protection_Manager::is_protected() ) {

			$add_rand_text = apply_filters( 'all_in_one_blur_protection_rand_text', true );
			if ( $add_rand_text ) {
				$content = Helper::get_random_text( $content );
			}

			$blur_level = isset( $restriction['blur_level'] ) ? $restriction['blur_level'] : 10;
			$spread     = isset( $restriction['spread'] ) ? $restriction['spread'] : 10;

			return sprintf( '<%s class="aiocr-blur" style="-webkit-filter: blur(%spx); text-shadow: 0 0 %spx #000;">%s</%s>', $html_tag, esc_attr( $blur_level ), esc_attr( $spread ), $content, $html_tag );
		}

		return $content;
	}
}

new Blur;