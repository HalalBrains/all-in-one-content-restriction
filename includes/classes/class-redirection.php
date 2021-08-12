<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Redirection extends Protection_Base {

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

		if ( 'redirect' !== $this->settings['protection_type'] || ! isset( $this->settings['protection_type'] ) ) {
			return;
		}

		add_action( 'template_redirect', array( $this, 'template_redirect' ) );
	}

	public function template_redirect() {

		if ( is_archive() || is_home() ) {
			return;
		}

		if ( $this->users_can_see() || ! $this->is_protected( get_the_ID() ) ) {
			return;
		}

		if ( ! isset( $this->settings['redirection_type'] ) || empty( $this->settings['redirection_type'] ) ) {
			return;
		}

		$redirect = false;

		switch ( $this->settings['redirection_type'] ) {
			case 'homepage':
				$redirect = home_url();
				break;

			case 'custom_url':
				$redirect = esc_url( $this->settings['custom_url'] );
				break;
		}

		if ( $redirect ) {
			wp_redirect( $redirect );
			exit;
		}
	}
}

Redirection::instance();