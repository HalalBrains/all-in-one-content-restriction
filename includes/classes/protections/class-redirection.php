<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.1
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Redirection extends Protection_Base {

	protected static $instance = null;

	public function __construct() {
		parent::__construct();
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function condition( $value ) {

		$this->single_restriction_data = $value;

		if ( 'redirect' !== $value['protection_type'] ) {
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

		if ( ! isset( $this->single_restriction_data['redirection_type'] ) || empty( $this->single_restriction_data['redirection_type'] ) ) {
			return;
		}

		$redirect = false;

		switch ( $this->single_restriction_data['redirection_type'] ) {
			case 'homepage':
				$redirect = home_url();
				break;

			case 'custom_url':
				$redirect = esc_url( $this->single_restriction_data['custom_url'] );
				break;
		}

		if ( $redirect ) {
			wp_redirect( $redirect );
			exit;
		}
	}
}

Redirection::instance();