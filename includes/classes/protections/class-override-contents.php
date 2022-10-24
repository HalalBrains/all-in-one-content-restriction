<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.6.4
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Override_Contents {

	public $restrictions = array();

	public function __construct() {
		add_filter( 'the_title', array( $this, 'the_title' ), 10, 2 );
		add_filter( 'the_content', array( $this, 'the_content' ) );
		add_filter( 'get_the_excerpt', array( $this, 'the_excerpt' ), 11, 2 );
	}

	public function the_title( $title, $post_id ) {

		$this->restrictions = Protection_Manager::instance()->get_restrictions( $post_id, '', 'override_contents' );

		foreach ( $this->restrictions as $key => $restriction ) {
			if ( $restriction['the_title'] ) {
				$title = $this->show_content( $title,
					Helper::add_suffix_prefix( '%%title%%', $title, $restriction['the_title'] ),
					$restriction );
			}
		}

		return $title;
	}

	public function the_excerpt( $the_excerpt, $post ) {

		foreach ( $this->restrictions as $key => $restriction ) {
			if ( $restriction['the_excerpt'] ) {
				$the_excerpt = $this->show_content( $the_excerpt,
					Helper::add_suffix_prefix( '%%excerpt%%', $the_excerpt, $restriction['the_excerpt'] ),
					$restriction );
			}
		}

		return $the_excerpt;
	}

	public function the_content( $the_content ) {

		foreach ( $this->restrictions as $key => $restriction ) {
			if ( $restriction['the_content'] ) {
				$the_content = $this->show_content( $the_content,
					Helper::add_suffix_prefix( '%%content%%', $the_content, $restriction['the_content'] ),
					$restriction );
			}
		}

		return $the_content;
	}

	private function show_content( $content, $modified_content, $restriction ) {

		if ( Protection_Manager::users_can_see( $restriction ) ) {
			return $content;
		}

		if ( Protection_Manager::is_protected() ) {
			return $modified_content;
		}

		return $content;
	}
}

new Override_Contents;