<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Content_Restriction;

use HeyMehedi\Content_Restriction\Settings;

class Controller {

	protected static $instance = null;
	private $settings;

	public function __construct() {
		// add_filter( 'the_title', array( $this, 'filter_the_title' ), 10, 2 );
		// add_filter( 'get_the_excerpt', array( $this, 'filter_the_excerpt' ), 11, 2 );

		$this->settings = Settings::get();

		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'wp_ajax_content_restriction_update_settings', array( $this, 'wp_ajax_content_restriction_update_settings' ) );

		add_action( 'wp_ajax_content_restriction_wise', array( $this, 'wp_ajax_content_restriction_wise' ) );
		add_action( 'wp_ajax_content_restriction_wise_selected', array( $this, 'wp_ajax_content_restriction_wise_selected' ) );

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
		Helper::get_template_part( 'menu-page', $this->settings );
	}

	// Ajax
	public function wp_ajax_content_restriction_update_settings() {
		Settings::set( $_POST );
		wp_die();
	}

	public function wp_ajax_content_restriction_wise() {

		$restriction_wise  = $_POST['restrictionWise'];
		$exclude_ids_index = $restriction_wise . '_ids';
		$icon              = 'dashicons-plus-alt2';
		$settings          = $this->settings;
		$exclude_ids       = $settings[$exclude_ids_index];

		echo Helper::display_items( $restriction_wise, $icon, $exclude_ids );
		wp_die();

		return;
	}

	public function wp_ajax_content_restriction_wise_selected() {

		$restriction_wise     = $_POST['restrictionWise'];
		$selected_items_index = $restriction_wise . '_ids';
		$icon                 = 'dashicons-minus';
		$settings             = $this->settings;
		$selected_items       = $settings[$selected_items_index];

		if ( empty( $selected_items ) ) {
			echo Helper::get_not_found_html();
			wp_die();
		}

		echo Helper::display_items( $restriction_wise, $icon, array(), $selected_items );

		wp_die();
	}

}

Controller::instance();