<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.1.1
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class General {

	protected static $instance = null;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function admin_menu() {
		add_menu_page(
			esc_html( 'Dashboard - All in One Content Restriction', 'all-in-one-content-restriction' ),
			esc_html( 'Dashboard', 'all-in-one-content-restriction' ),
			'manage_options',
			'all-in-one-content-restriction',
			array( $this, 'dashboard' ),
			Helper::get_file_uri( 'admin/images/dash-icon.png' ),
			6
		);

		add_submenu_page(
			'all-in-one-content-restriction',
			esc_html( 'Restrictions - AIO Content Restriction', 'all-in-one-content-restriction' ),
			esc_html( 'Restrictions', 'all-in-one-content-restriction' ),
			'manage_options',
			'restrictions',
			array( $this, 'restrictions' ),
			6
		);
	}

	public function restrictions() {
		if ( isset( $_GET['action'] ) && 'new' === $_GET['action'] ) {
			return Helper::get_template_part_admin( 'menu-page' );
		}

		if (  ( isset( $_GET['action'] ) && 'edit' === $_GET['action'] ) && ( isset( $_GET['id'] ) && ! empty( $_GET['id'] ) ) ) {
			$settings     = Settings::get();
			$restrictions = isset( $settings['restrictions'] ) ? $settings['restrictions'] : array();

			foreach ( $restrictions as $key => $value ) {
				if ( $_GET['id'] == $value['restriction_id'] ) {
					return Helper::get_template_part_admin( 'menu-page', $value );
				}
			}
		}

		if ( isset( $_POST['action'] ) && 'trash' === $_POST['action'] ) {
			Settings::drop( $_POST );
		}

		Helper::get_template_part_admin( 'menu-list-table', new AIOCR_List_Table() );
	}

	public function dashboard() {
		return Helper::get_template_part_admin( 'dashboard' );
	}

}

General::instance();