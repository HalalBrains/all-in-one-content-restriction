<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Exlac;

use HeyMehedi\Exlac\Settings;

class Ajax_Handler {

	protected static $instance = null;
	private $settings;

	public function __construct() {
		$this->settings = Settings::get();

		add_action( 'wp_ajax_exlac_update_settings', array( $this, 'wp_ajax_exlac_update_settings' ) );
		add_action( 'wp_ajax_exlac_show_not_selected_items', array( $this, 'wp_ajax_exlac_show_not_selected_items' ) );
		add_action( 'wp_ajax_exlac_show_selected_items', array( $this, 'wp_ajax_exlac_show_selected_items' ) );
		add_action( 'wp_ajax_exlac_not_found_html', array( $this, 'wp_ajax_exlac_not_found_html' ) );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function wp_ajax_exlac_update_settings() {
		Settings::set( $_POST );
		wp_die();
	}

	public function wp_ajax_exlac_show_not_selected_items() {
		$restrict_in       = $_POST['restrictionIn'];
		$exclude_ids_index = $restrict_in . '_ids';
		$icon              = 'dashicons-plus-alt2';
		$settings          = $this->settings;
		$exclude_ids       = $settings[$exclude_ids_index];

		echo Helper::display_items( $restrict_in, $icon, $exclude_ids );
		wp_die();

		return;
	}

	public function wp_ajax_exlac_show_selected_items() {
		$restrict_in          = $_POST['restrictionIn'];
		$selected_items_index = $restrict_in . '_ids';
		$icon                 = 'dashicons-minus';
		$settings             = $this->settings;
		$selected_items       = $settings[$selected_items_index];

		if ( empty( $selected_items ) ) {
			echo Helper::get_not_found_html();
			wp_die();
		}

		echo Helper::display_items( $restrict_in, $icon, array(), $selected_items );

		wp_die();
	}

	public function wp_ajax_exlac_not_found_html() {
		echo Helper::get_not_found_html();
		wp_die();
	}

}

Ajax_Handler::instance();