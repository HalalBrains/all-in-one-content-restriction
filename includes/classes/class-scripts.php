<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Exlac;

use HeyMehedi\Exlac;

class Scripts {

	public $version;
	protected static $instance = null;

	public function __construct() {
		$this->version = Exlac::$version;
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
		wp_register_style( 'bootstrap', '//cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css', array(), $this->version );
		wp_register_style( 'select2', '//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', array(), $this->version );
		wp_register_style( 'exlac-main', Helper::get_file_uri( 'admin/css/style.css' ), array(), $this->version );

		// JS
		wp_register_script( 'select2', '//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array( 'jquery' ), $this->version, true );
		wp_register_script( 'exlac-main', Helper::get_file_uri( 'admin/js/main.js' ), array( 'jquery' ), $this->version, true );
	}

	public function enqueue_scripts() {
		// Bootstrap
		wp_enqueue_style( 'bootstrap' );

		wp_enqueue_style( 'select2' );
		wp_enqueue_script( 'select2' );

		// plugin JS
		wp_enqueue_script( 'exlac-main' );
		wp_localize_script( 'exlac-main', 'heymehedi_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

		wp_enqueue_style( 'exlac-main' );

	}

}

Scripts::instance();