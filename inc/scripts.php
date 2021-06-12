<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Content_Restriction;

use HeyMehedi\Content_Restriction;

class Scripts {

	public $version;
	protected static $instance = null;

	public function __construct() {
		$this->version = Content_Restriction::$version;
		add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts' ), 12 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ), 15 );
	}

	public static function instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function register_scripts() {
		// Bootstrap
		wp_register_style( 'bootstrap', Helper::get_vendor_assets( 'bootstrap/css/bootstrap.min.css' ), array(), $this->version );
		wp_register_script( 'bootstrap', Helper::get_vendor_assets( 'bootstrap/js/bootstrap.bundle.min.js' ), array( 'jquery' ), $this->version, true );
		// Main js
		wp_register_script( 'content-restriction-main', Helper::get_js( 'main' ), array( 'jquery' ), $this->version, true );
	}

	public function enqueue_scripts() {
		// Bootstrap
		wp_enqueue_style( 'bootstrap' );
		wp_enqueue_script( 'bootstrap' );

		// plugin JS
		wp_enqueue_script( 'content-restriction-main' );
		wp_localize_script( 'content-restriction-main', 'heymehedi_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

	}

}

Scripts::instance();