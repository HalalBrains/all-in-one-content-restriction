<?php
/**
 * @author  HeyMehedi
 * @since   1.5
 * @version 1.6.4
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Obfuscate {

	public $restrictions = array();

	public function __construct() {
		add_filter( 'the_title', array( $this, 'the_title' ), 10, 2 );
		add_filter( 'the_content', array( $this, 'the_content' ) );
		add_filter( 'get_the_excerpt', array( $this, 'the_excerpt' ), 11, 2 );
	}

	public function the_title( $title, $post_id ) {
		$this->restrictions = Protection_Manager::instance()->get_restrictions( $post_id, '', 'obfuscate' );

		foreach ( $this->restrictions as $key => $restriction ) {
			$obfuscate_apply_to = isset( $restriction['obfuscate_apply_to'] ) ? $restriction['obfuscate_apply_to'] : array();
			if ( in_array( 'the_title', $obfuscate_apply_to ) ) {
				$title = $this->add_obfuscate( $title, $restriction );
			}
		}

		return $title;
	}

	public function the_excerpt( $the_excerpt, $post ) {

		foreach ( $this->restrictions as $key => $restriction ) {
			$obfuscate_apply_to = isset( $restriction['obfuscate_apply_to'] ) ? $restriction['obfuscate_apply_to'] : array();
			if ( in_array( 'the_excerpt', $obfuscate_apply_to ) ) {
				$the_excerpt = $this->add_obfuscate( $the_excerpt, $restriction );
			}
		}

		return $the_excerpt;
	}

	public function the_content( $the_content ) {

		foreach ( $this->restrictions as $key => $restriction ) {
			$obfuscate_apply_to = isset( $restriction['obfuscate_apply_to'] ) ? $restriction['obfuscate_apply_to'] : array();
			if ( in_array( 'the_content', $obfuscate_apply_to ) ) {
				$the_content = $this->add_obfuscate( $the_content, $restriction );
			}
		}

		return $the_content;
	}

	private function add_obfuscate( $content, $restriction ) {

		if ( Protection_Manager::users_can_see( $restriction ) ) {
			return $content;
		}

		if ( Protection_Manager::is_protected() ) {
			return Helper::get_random_text( $content );
		}

		return $content;
	}
}

new Obfuscate;