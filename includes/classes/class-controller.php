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
		Helper::get_template_part('menu-page');
	}

	// Ajax
	public function wp_ajax_content_restriction_update_settings() {
		Update::save_setting_data( $_POST );
		wp_die();
	}

	public function wp_ajax_content_restriction_wise() {

		$settings       = Content_Restriction::$options;
		$selected_items = isset( $settings['itemIds'] ) ? $settings['itemIds'] : array(); // Exlucded items what user selected

		$restriction_wise = $_POST['restriction-wise'];
		$icon             = 'dashicons-plus-alt2';
		$exclude_ids      = $selected_items;
		$this->display_items( $restriction_wise, $icon, $exclude_ids );
		wp_die();

	}

	public function wp_ajax_content_restriction_wise_selected() {

		$settings       = Content_Restriction::$options;
		$selected_items = isset( $settings['itemIds'] ) ? $settings['itemIds'] : array(); // Show Only What user selected

		$restriction_wise = $_POST['restriction-wise'];
		$icon             = 'dashicons-minus';
		$this->display_items( $restriction_wise, $icon, array(), $selected_items );
		wp_die();

	}

	private function display_items( $restriction_wise, $icon, $exclude_ids = array(), $selected_items = array() ) {

		if ( 'category' === $restriction_wise ) {
			$items_array = Query::get_categories( $exclude_ids, $selected_items );
			echo $this->get_items_html( $items_array, $icon, 'category' );
		}

		if ( 'single-post' === $restriction_wise ) {
			$items_array = Query::get_posts( $exclude_ids, $selected_items );
			echo $this->get_items_html( $items_array, $icon, 'single-post' );
			wp_die();
		}

	}

	private function get_items_html( $items_array, $icon, $wise_type ) {

		$items_list_html = '';

		if ( ! $items_array ) {
			esc_html_e( 'Sorry, no items found!' );
			wp_die();
		}

		if ( 'category' === $wise_type ) {
			foreach ( $items_array->terms as $id => $name ) {
				$items_list_html .= sprintf( '<tr data-item-id="%s"><td class="text-center action"><div class="dashicons-before %s" aria-hidden="true"></div></td><td class="text-center">%s</td><td>%s</td></tr>', $id, $icon, $id, $name );
			}
		}

		if ( 'single-post' === $wise_type ) {
			foreach ( $items_array as $id ) {
				$items_list_html .= sprintf( '<tr data-item-id="%s"><td class="text-center action"><div class="dashicons-before %s" aria-hidden="true"></div></td><td class="text-center">%s</td><td>%s</td></tr>', $id, $icon, $id, get_the_title( $id ) );
			}
		}

		return $items_list_html;
	}

}

Controller::instance();