<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Exlac;

use HeyMehedi\Exlac\Settings;

class General {

	protected static $instance = null;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function admin_menu() {
		add_menu_page(
			esc_html( Strings::get()[100] ),
			esc_html( Strings::get()[100] ),
			'manage_options',
			'exlac',
			array( $this, 'menu_page' ),
			'dashicons-privacy',
			6
		);
	}

	public function menu_page() {
		Helper::get_template_part( 'menu-page', Settings::get() );
	}

}

General::instance();