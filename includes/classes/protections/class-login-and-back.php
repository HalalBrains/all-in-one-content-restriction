<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.6.4
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

		$restrictions = Protection_Manager::instance()->get_restrictions( get_the_ID(), '', 'login_and_back' );

		if ( ! Protection_Manager::is_protected() ) {
			return;
		}

		foreach ( $restrictions as $key => $restriction ) {

			/* don't redirect, if it's a archive or blog */
			if ( in_array( $restriction['restrict_in'], array( 'all_items', 'selected_single_items' ) ) ) {
				if ( is_archive() || is_home() ) {
					continue;
				}
			}

			$url = wp_login_url( $this->current_url() );
			if ( $url ) {
				wp_redirect( $url );
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