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
			esc_html( 'All in One Content Restriction', 'all-in-one-content-restriction' ),
			esc_html( 'AIO Content Restriction', 'all-in-one-content-restriction' ),
			'manage_options',
			'all-in-one-content-restriction',
			array( $this, 'menu_page' ),
			Helper::get_file_uri( 'admin/images/dash-icon.png' ),
			6
		);
	}

	public function menu_page() {

		if ( isset( $_GET['action'] ) && 'new' === $_GET['action'] ) {
			return Helper::get_template_part( 'menu-page' );
		}

		if (  ( isset( $_GET['action'] ) && 'edit' === $_GET['action'] ) && ( isset( $_GET['id'] ) && ! empty( $_GET['id'] ) ) ) {
			$settings     = Settings::get();
			$restrictions = isset( $settings['restrictions'] ) ? $settings['restrictions'] : array();

			foreach ( $restrictions as $key => $value ) {
				if ( $_GET['id'] == $value['restriction_id'] ) {
					return Helper::get_template_part( 'menu-page', $value );
				}
			}
		}

		if ( isset( $_POST['action'] ) && 'trash' === $_POST['action'] ) {
			Settings::drop( $_POST );
		}

		Helper::get_template_part( 'menu-list-table', new AIOCR_List_Table() );

	}

}

General::instance();