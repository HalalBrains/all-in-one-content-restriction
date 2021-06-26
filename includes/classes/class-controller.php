<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Content_Restriction;

use HeyMehedi\Content_Restriction;

class Controller {

	protected static $instance = null;

	public function __construct() {
		// add_filter( 'the_title', array( $this, 'filter_the_title' ), 10, 2 );
		// add_filter( 'get_the_excerpt', array( $this, 'filter_the_excerpt' ), 11, 2 );

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
		Helper::get_template_part( 'menu-page' );
		$settings = Content_Restriction::$options;
		print_r( $settings );
	}

	public static function get_settings() {
		$options                      = Content_Restriction::$options;
		$settings['post_type']        = isset( $options['posttype'] ) ? $options['posttype'] : 'post';
		$settings['restriction_wise'] = isset( $options['restrictionWise'] ) ? $options['restrictionWise'] : 'category';
		$settings['selected_items']   = isset( $options['itemIds'] ) ? $options['itemIds'] : array();

		return $settings;
	}

	// Ajax
	public function wp_ajax_content_restriction_update_settings() {
		Update::save_setting_data( $_POST );
		wp_die();
	}

	public function wp_ajax_content_restriction_wise() {

		$settings         = self::get_settings();
		$exclude_ids      = $settings['selected_items'];
		$restriction_wise = $_POST['restriction-wise'];
		$icon             = 'dashicons-plus-alt2';
		
		echo Helper::display_items( $restriction_wise, $icon, $exclude_ids );
		
		wp_die();

	}

	public function wp_ajax_content_restriction_wise_selected() {

		$settings       = self::get_settings();
		$selected_items = $settings['selected_items'];

		if ( empty( $selected_items ) ) {
			wp_die();

			return;
		}

		$restriction_wise = $_POST['restriction-wise'];
		$icon             = 'dashicons-minus';
		
		echo Helper::display_items( $restriction_wise, $icon, array(), $selected_items );
	
		wp_die();

	}

}

Controller::instance();