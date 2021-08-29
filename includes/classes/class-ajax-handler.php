<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.1
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

use HeyMehedi\All_In_One_Content_Restriction\Settings;

class Ajax_Handler {

	protected static $instance = null;
	private $settings;

	public function __construct() {
		$this->settings = Settings::get();

		add_action( 'wp_ajax_all_in_one_content_restriction_update_settings', array( $this, 'wp_ajax_all_in_one_content_restriction_update_settings' ) );
		add_action( 'wp_ajax_all_in_one_content_restriction_show_not_selected_items', array( $this, 'wp_ajax_all_in_one_content_restriction_show_not_selected_items' ) );
		add_action( 'wp_ajax_all_in_one_content_restriction_show_selected_items', array( $this, 'wp_ajax_all_in_one_content_restriction_show_selected_items' ) );
		add_action( 'wp_ajax_all_in_one_content_restriction_not_found_html', array( $this, 'wp_ajax_all_in_one_content_restriction_not_found_html' ) );

		// V1.1
		add_action( 'wp_ajax_all_in_one_content_restriction_restriction_in', array( $this, 'wp_ajax_all_in_one_content_restriction_restriction_in' ) );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function wp_ajax_all_in_one_content_restriction_update_settings() {
		Settings::set( $_POST );
		wp_die();
	}

	public function wp_ajax_all_in_one_content_restriction_show_not_selected_items() {
		$restrict_in       = sanitize_text_field( $_POST['restrictionIn'] );
		$exclude_ids_index = $restrict_in . '_ids';
		$icon              = 'dashicons-plus-alt2';
		$settings          = $this->settings;
		$exclude_ids       = $settings[$exclude_ids_index];

		echo Helper::display_items( $restrict_in, $icon, $exclude_ids );
		wp_die();

		return;
	}

	public function wp_ajax_all_in_one_content_restriction_show_selected_items() {
		$restrict_in          = sanitize_text_field( $_POST['restrictionIn'] );
		$selected_items_index = $restrict_in . '_ids';
		$icon                 = 'dashicons-minus';
		$settings             = $this->settings;
		$selected_items       = $settings[$selected_items_index];

		if ( empty( $selected_items ) ) {
			echo Markup_Manager::get_not_found_html();
			wp_die();
		}

		echo Helper::display_items( $restrict_in, $icon, array(), $selected_items );

		wp_die();
	}

	public function wp_ajax_all_in_one_content_restriction_not_found_html() {
		echo Markup_Manager::get_not_found_html();
		wp_die();
	}

	public function wp_ajax_all_in_one_content_restriction_restriction_in() {
		echo Markup_Manager::get_taxonomies_options( esc_attr( $_POST['restriction_in'] ) );
		wp_die();
	}
}

Ajax_Handler::instance();