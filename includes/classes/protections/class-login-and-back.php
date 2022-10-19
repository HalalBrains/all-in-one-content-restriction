<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.6.3
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Login_And_Back {

	public function __construct() {
		add_action( 'template_redirect', array( $this, 'template_redirect' ) );
		add_filter( 'register_url', array( $this, 'register_url' ) );
	}

	public function template_redirect() {

		if ( is_user_logged_in() ) {
			return;
		}

		$matched_restrictions = Protection_Manager::instance()->get_matched_restrictions( get_the_ID() );

		if ( ! Protection_Manager::is_protected() ) {
			return;
		}

		foreach ( $matched_restrictions as $key => $single_restriction_data ) {
			$protection_type = isset( $single_restriction_data['protection_type'] ) ? $single_restriction_data['protection_type'] : null;
			if ( 'login_and_back' != $protection_type ) {
				continue;
			}

			// Check if it's a archive or blog, don't redirect it.
			if ( in_array( $single_restriction_data['restrict_in'], array( 'all_items', 'selected_single_items' ) ) ) {
				if ( is_archive() || is_home() ) {
					continue;
				}
			}

			$requested_and_login = wp_login_url( $this->current_url() );

			if ( $requested_and_login ) {
				wp_redirect( $requested_and_login );
				exit;
			}
		}
	}

	private function current_url() {
		$protocol = ( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' ) || $_SERVER['SERVER_PORT'] == 443 ? 'https://' : 'http://';

		return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
	}

	public function register_url( $str ) {
		return site_url( "wp-login.php?action=register&redirect_to={$this->current_url()}", 'login' );
	}
}

new Login_And_Back;