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

		add_action( 'wp_ajax_exlac_wise', array( $this, 'wp_ajax_exlac_wise' ) );
		add_action( 'wp_ajax_exlac_wise_selected', array( $this, 'wp_ajax_exlac_wise_selected' ) );

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

	public function wp_ajax_exlac_wise() {

		$restriction_wise  = $_POST['restrictionWise'];
		$exclude_ids_index = $restriction_wise . '_ids';
		$icon              = 'dashicons-plus-alt2';
		$settings          = $this->settings;
		$exclude_ids       = $settings[$exclude_ids_index];

		echo Helper::display_items( $restriction_wise, $icon, $exclude_ids );
		wp_die();

		return;
	}

	public function wp_ajax_exlac_wise_selected() {

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

Ajax_Handler::instance();