<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.6.4
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Redirection {

	public function __construct() {
		add_action( 'template_redirect', array( $this, 'template_redirect' ), 1 );
	}

	public function template_redirect() {

		$restrictions = Protection_Manager::instance()->get_restrictions( get_the_ID(), '', 'redirect' );

		if ( ! Protection_Manager::is_protected() ) {
			return;
		}

		foreach ( $restrictions as $key => $restriction ) {
			$redirect = false;

			// Check if it's a archive or blog, don't redirect it.
			if ( in_array( $restriction['restrict_in'], array( 'all_items', 'selected_single_items' ) ) ) {
				if ( is_archive() || is_home() || $restriction['post_type'] !== get_post_type( get_the_ID() ) ) {
					continue;
				}
			}

			// If current user has permission to see the post
			if ( Protection_Manager::users_can_see( $restriction ) ) {
				return;
			}

			switch ( $restriction['redirection_type'] ) {
				case 'homepage':
					$redirect = home_url();
					break;
				case 'custom_url':
					$redirect = esc_url( $restriction['custom_url'] );
					break;
			}

			if ( $redirect ) {
				wp_redirect( $redirect );
				exit;
			}
		}
	}
}

new Redirection;