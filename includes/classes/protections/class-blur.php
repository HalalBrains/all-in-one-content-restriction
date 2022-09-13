<?php
/**
 * @author  HeyMehedi
 * @since   1.4
 * @version 1.6.1
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Blur {

	public $matched_restrictions = array();

	public function __construct() {
		add_filter( 'the_title', array( $this, 'the_title' ), 10, 2 );
		add_filter( 'the_content', array( $this, 'the_content' ) );
		add_filter( 'get_the_excerpt', array( $this, 'the_excerpt' ), 11, 2 );
	}

	public function the_title( $title, $post_id ) {

		$this->matched_restrictions = Protection_Manager::instance()->get_matched_restrictions( $post_id );

		foreach ( $this->matched_restrictions as $key => $single_restriction_data ) {
			$protection_type = isset( $single_restriction_data['protection_type'] ) ? $single_restriction_data['protection_type'] : null;
			if ( 'blur' != $protection_type ) {
				continue;
			}

			$blur_apply_to = isset( $single_restriction_data['blur_apply_to'] ) ? $single_restriction_data['blur_apply_to'] : array();
			if ( in_array( 'the_title', $blur_apply_to ) ) {
				$title = $this->add_blur_class( $title, $single_restriction_data );
			}
		}

		return $title;
	}

	public function the_excerpt( $the_excerpt, $post ) {

		foreach ( $this->matched_restrictions as $key => $single_restriction_data ) {
			$protection_type = isset( $single_restriction_data['protection_type'] ) ? $single_restriction_data['protection_type'] : null;

			if ( 'blur' != $protection_type ) {
				continue;
			}

			$blur_apply_to = isset( $single_restriction_data['blur_apply_to'] ) ? $single_restriction_data['blur_apply_to'] : array();
			if ( in_array( 'the_excerpt', $blur_apply_to ) ) {
				$the_excerpt = $this->add_blur_class( $the_excerpt, $single_restriction_data );
			}
		}

		return $the_excerpt;
	}

	public function the_content( $the_content ) {

		foreach ( $this->matched_restrictions as $key => $single_restriction_data ) {
			$protection_type = isset( $single_restriction_data['protection_type'] ) ? $single_restriction_data['protection_type'] : null;
			if ( 'blur' != $protection_type ) {
				continue;
			}

			$blur_apply_to = isset( $single_restriction_data['blur_apply_to'] ) ? $single_restriction_data['blur_apply_to'] : array();
			if ( in_array( 'the_content', $blur_apply_to ) ) {
				$the_content = $this->add_blur_class( $the_content, $single_restriction_data, 'div' );
			}
		}

		return $the_content;
	}

	private function add_blur_class( $content, $single_restriction_data, $html_tag = 'span' ) {

		if ( Protection_Manager::users_can_see( $single_restriction_data ) ) {
			return $content;
		}

		if ( Protection_Manager::is_protected() ) {

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

new Blur;