<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Login_And_Back extends Protection_Base {

	protected static $instance = null;

	public function __construct() {
		parent::__construct();
		$this->condition();
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	private function condition() {

		if ( 'login_and_back' !== $this->settings['protection_type'] || ! isset( $this->settings['protection_type'] ) ) {
			return;
		}

		add_action( 'template_redirect', array( $this, 'template_redirect' ) );
	}

	public function template_redirect() {

		if ( is_user_logged_in() ) {
			return;
		}

		if ( is_archive() || is_home() ) {
			return;
		}

		if ( ! $this->is_protected( get_the_ID() ) ) {
			return;
		}

		$requested_and_login = wp_login_url( $this->current_url() );

		if ( $requested_and_login ) {
			wp_redirect( $requested_and_login );
			exit;
		}
	}

	private function current_url() {
		$protocol = ( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' ) || $_SERVER['SERVER_PORT'] == 443 ? 'https://' : 'http://';

		return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
	}
}

Login_And_Back::instance();