<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\All_In_One_Content_Restriction
;

use HeyMehedi\All_In_One_Content_Restriction;

class Scripts {

	public $version;
	protected static $instance = null;

	public function __construct() {
		$this->version = All_In_One_Content_Restriction::$version;
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

		// CSS
		wp_register_style( 'bootstrap', Helper::get_file_uri( 'admin/css/bootstrap.min.css' ), array(), $this->version );
		wp_register_style( 'select2', Helper::get_file_uri( 'admin/css/select2.min.css' ), array(), $this->version );
		wp_register_style( 'all-in-one-content-restriction-main', Helper::get_file_uri( 'admin/css/style.css' ), array(), $this->version );

		// JS
		wp_register_script( 'select2', Helper::get_file_uri( 'admin/js/select2.min.js' ), array( 'jquery' ), $this->version, true );
		wp_register_script( 'all-in-one-content-restriction-main', Helper::get_file_uri( 'admin/js/main.js' ), array( 'jquery' ), $this->version, true );
	}

	public function enqueue_scripts() {
		// CSS
		wp_enqueue_style( 'bootstrap' );
		wp_enqueue_style( 'select2' );
		wp_enqueue_style( 'all-in-one-content-restriction-main' );

		// JS
		wp_enqueue_script( 'select2' );
		wp_enqueue_script( 'all-in-one-content-restriction-main' );
		wp_localize_script( 'all-in-one-content-restriction-main', 'heymehedi_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	}

}

Scripts::instance();