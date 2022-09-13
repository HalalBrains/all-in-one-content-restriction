<?php
/**
 * @author  HeyMehedi
 * @since   1.5
 * @version 1.6.1
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Obfuscate {

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
			if ( 'obfuscate' != $protection_type ) {
				continue;
			}

			$obfuscate_apply_to = isset( $single_restriction_data['obfuscate_apply_to'] ) ? $single_restriction_data['obfuscate_apply_to'] : array();
			if ( in_array( 'the_title', $obfuscate_apply_to ) ) {
				$title = $this->add_obfuscate( $title, $single_restriction_data );
			}
		}

		return $title;
	}

	public function the_excerpt( $the_excerpt, $post ) {

		foreach ( $this->matched_restrictions as $key => $single_restriction_data ) {
			$protection_type = isset( $single_restriction_data['protection_type'] ) ? $single_restriction_data['protection_type'] : null;

			if ( 'obfuscate' != $protection_type ) {
				continue;
			}

			$obfuscate_apply_to = isset( $single_restriction_data['obfuscate_apply_to'] ) ? $single_restriction_data['obfuscate_apply_to'] : array();
			if ( in_array( 'the_excerpt', $obfuscate_apply_to ) ) {
				$the_excerpt = $this->add_obfuscate( $the_excerpt, $single_restriction_data );
			}
		}

		return $the_excerpt;
	}

	public function the_content( $the_content ) {

		foreach ( $this->matched_restrictions as $key => $single_restriction_data ) {
			$protection_type = isset( $single_restriction_data['protection_type'] ) ? $single_restriction_data['protection_type'] : null;

			if ( 'obfuscate' != $protection_type ) {
				continue;
			}

			$obfuscate_apply_to = isset( $single_restriction_data['obfuscate_apply_to'] ) ? $single_restriction_data['obfuscate_apply_to'] : array();
			if ( in_array( 'the_content', $obfuscate_apply_to ) ) {
				$the_content = $this->add_obfuscate( $the_content, $single_restriction_data );
			}
		}

		return $the_content;
	}

	private function add_obfuscate( $content, $single_restriction_data ) {

		if ( Protection_Manager::users_can_see( $single_restriction_data ) ) {
			return $content;
		}

		if ( Protection_Manager::is_protected() ) {
			return Helper::get_random_text( $content );
		}

		return $content;
	}
}

new Obfuscate;