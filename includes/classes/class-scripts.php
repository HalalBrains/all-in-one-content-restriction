<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.4
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

use HeyMehedi\All_In_One_Content_Restriction;

class Scripts {

	public $version;
	protected static $instance = null;

	public function __construct() {
		$this->version = All_In_One_Content_Restriction::$version;

		// Admin Assets
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_register_scripts' ), 12 );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 15 );

		// Public Assets
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ), 10 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 10 );
	}

	public static function instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function admin_register_scripts() {

		// CSS
		wp_register_style( 'bootstrap', Helper::get_file_uri( 'admin/css/bootstrap.min.css' ), array(), $this->version );
		wp_register_style( 'select2', Helper::get_file_uri( 'admin/css/select2.min.css' ), array(), $this->version );
		wp_register_style( 'all-in-one-content-restriction-main', Helper::get_file_uri( 'admin/css/style.css' ), array(), $this->version );

		// JS
		wp_register_script( 'select2', Helper::get_file_uri( 'admin/js/select2.min.js' ), array( 'jquery' ), $this->version, true );
		wp_register_script( 'popper', Helper::get_file_uri( 'admin/js/popper.min.js' ), array( 'jquery' ), $this->version, true );
		wp_register_script( 'bootstrap', Helper::get_file_uri( 'admin/js/bootstrap.min.js' ), array( 'jquery' ), $this->version, true );
		wp_register_script( 'all-in-one-content-restriction-main', Helper::get_file_uri( 'admin/js/main.js' ), array( 'jquery' ), $this->version, true );
	}

	public function admin_enqueue_scripts( $hook ) {

		if ( 'toplevel_page_all-in-one-content-restriction' != $hook ) {
			return;
		}

		if ( isset( $_GET['action'] ) ) {
			// CSS
			wp_enqueue_style( 'bootstrap' );
			wp_enqueue_style( 'select2' );

			// JS
			wp_enqueue_script( 'select2' );
			wp_enqueue_script( 'popper' );
			wp_enqueue_script( 'bootstrap' );
		}

		// jQuery UI Slider / enqueue from wordpress
		wp_enqueue_script( 'jquery-ui-slider' );

		wp_enqueue_style( 'all-in-one-content-restriction-main' );
		wp_enqueue_script( 'all-in-one-content-restriction-main' );
		wp_localize_script( 'all-in-one-content-restriction-main', 'heymehedi_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	}

	public function register_scripts() {
		// Styles
		wp_register_style( 'all-in-one-content-restriction-main', Helper::get_file_uri( 'public/css/style.css' ), array(), $this->version );

		// Scripts
		wp_register_script( 'all-in-one-content-restriction-main', Helper::get_file_uri( 'public/js/main.js' ), array( 'jquery' ), $this->version, true );

		$data = array(
			'ajaxurl'     => admin_url( 'admin-ajax.php' ),
			'contextmenu' => 'Y',
			'drag'        => 'Y',
			'diskey'      => 'Y',
		);

		wp_localize_script( 'all-in-one-content-restriction-main', 'all_in_one_content_restriction_main_localize_data', apply_filters( 'all_in_one_content_restriction_main_localize_data', $data ) );
	}

	public function enqueue_scripts() {
		// Styles
		wp_enqueue_style( 'all-in-one-content-restriction-main' );

		// Scripts
		wp_enqueue_script( 'all-in-one-content-restriction-main' );
	}

}

Scripts::instance();