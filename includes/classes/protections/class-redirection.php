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
		add_action( 'template_redirect', array( $this, 'template_redirect' ) );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function template_redirect() {

		if ( ! $this->is_protected( get_the_ID() ) ) {
			return;
		}

		foreach ( $this->matched_restrictions as $key => $value ) {

			if ( $this->users_can_see( $value ) ) {
				return;
			}

			if ( 'redirect' != $value['protection_type'] ) {
				return;
			} else {
				$redirect = false;

				switch ( $value['redirection_type'] ) {
					case 'homepage':
						$redirect = home_url();
						break;

					case 'custom_url':
						$redirect = esc_url( $value['custom_url'] );
						break;
				}

				if ( $redirect ) {
					wp_redirect( $redirect );
					exit;
				}
			}
		}
	}
}

Redirection::instance();