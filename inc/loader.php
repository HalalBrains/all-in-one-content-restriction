<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Content_Restriction;

class Loader {

	protected static $instance = null;

	public function __construct() {
		add_action( 'pre_get_posts', array( $this, 'pre_get_posts' ), 10 );
		add_filter( 'the_title', array( $this, 'filter_the_title' ), 10, 2 );
		add_filter( 'get_the_excerpt', array( $this, 'filter_the_excerpt' ), 11, 2 );

		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		// add_action( 'admin_init', array( $this, 'settings_init' ) );

		add_action( 'wp_ajax_content_restriction_update_settings', array( $this, 'content_restriction_update_settings' ) );

	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function admin_menu() {
		add_menu_page(
			__( 'Content Restriction', 'content-restriction' ),
			__( 'Content Restriction', 'content-restriction' ),
			'manage_options',
			'content-restriction',
			array( $this, 'menu_page' ),
			'dashicons-privacy',
			6
		);
	}

	public function menu_page() {
		Form::instance()->render();
	}

	public function content_restriction_update_settings() {
		Update::settings_data( $_POST );
	}

}

Loader::instance();