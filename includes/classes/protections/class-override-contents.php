<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.6.1
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Override_Contents {

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
			if ( 'override_contents' != $protection_type ) {
				continue;
			}

			if ( $single_restriction_data['the_title'] ) {
				$title = $this->show_content( $title,
					Helper::add_suffix_prefix( '%%title%%', $title, $single_restriction_data['the_title'] ),
					$single_restriction_data );
			}
		}

		return $title;
	}

	public function the_excerpt( $the_excerpt, $post ) {

		foreach ( $this->matched_restrictions as $key => $single_restriction_data ) {
			$protection_type = isset( $single_restriction_data['protection_type'] ) ? $single_restriction_data['protection_type'] : null;

			if ( 'override_contents' != $protection_type ) {
				continue;
			}

			if ( $single_restriction_data['the_excerpt'] ) {
				$the_excerpt = $this->show_content( $the_excerpt,
					Helper::add_suffix_prefix( '%%excerpt%%', $the_excerpt, $single_restriction_data['the_excerpt'] ),
					$single_restriction_data );
			}
		}

		return $the_excerpt;
	}

	public function the_content( $the_content ) {

		foreach ( $this->matched_restrictions as $key => $single_restriction_data ) {
			$protection_type = isset( $single_restriction_data['protection_type'] ) ? $single_restriction_data['protection_type'] : null;

			if ( 'override_contents' != $protection_type ) {
				continue;
			}

			if ( $single_restriction_data['the_content'] ) {
				$the_content = $this->show_content( $the_content,
					Helper::add_suffix_prefix( '%%content%%', $the_content, $single_restriction_data['the_content'] ),
					$single_restriction_data );
			}
		}

		return $the_content;
	}

	private function show_content( $content, $modified_content, $single_restriction_data ) {

		if ( Protection_Manager::users_can_see( $single_restriction_data ) ) {
			return $content;
		}

		if ( Protection_Manager::is_protected() ) {
			return $modified_content;
		}

		return $content;
	}
}

new Override_Contents;