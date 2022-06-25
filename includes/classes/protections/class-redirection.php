<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.1
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Redirection {

	public function __construct() {
		add_action( 'template_redirect', array( $this, 'template_redirect' ), 1 );
	}

	public function template_redirect() {

		$matched_restrictions = Protection_Manager::instance()->get_matched_restrictions( get_the_ID() );

		if ( ! Protection_Manager::is_protected() ) {
			return;
		}

		foreach ( $matched_restrictions as $key => $single_restriction_data ) {
			$protection_type = isset( $single_restriction_data['protection_type'] ) ? $single_restriction_data['protection_type'] : '';
			$redirect        = false;

			if ( 'redirect' != $protection_type ) {
				continue;
			}

			// Check if it's a archive or blog, don't redirect it.
			if ( in_array( $single_restriction_data['restrict_in'], array( 'all_items', 'selected_single_items' ) ) ) {
				if ( is_archive() || is_home() ) {
					continue;
				}
			}

			// If current user has permission to see the post
			if ( Protection_Manager::users_can_see( $single_restriction_data ) ) {
				return;
			}

			switch ( $single_restriction_data['redirection_type'] ) {
				case 'homepage':
					$redirect = home_url();
					break;
				case 'custom_url':
					$redirect = esc_url( $single_restriction_data['custom_url'] );
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