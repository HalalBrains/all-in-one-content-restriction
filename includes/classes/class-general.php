<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
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
			'dashicons-privacy',
			6
		);
	}

	public function menu_page() {
		e_var_dump($_POST);

		if ( isset( $_GET['action'] ) && 'new' === $_GET['action'] ) {
			return Helper::get_template_part( 'menu-page' );
		}

		if ( isset( $_GET['action'] ) && 'delete' === $_GET['action'] ) {
		}

		if (  ( isset( $_GET['action'] ) && 'edit' === $_GET['action'] ) && ( isset( $_GET['id'] ) && ! empty( $_GET['id'] ) ) ) {
			$settings     = Settings::get();
			$restrictions = isset( $settings['restrictions'] ) ? $settings['restrictions'] : array();

			foreach ( $restrictions as $key => $value ) {
				if ( $_GET['id'] == $value['restriction_id'] ) {
					return Helper::get_template_part( 'menu-page', $value );
				}
			}

		}?>

			<div class="wrap">

				<h2><?php _e( 'All in One Content Restriction', 'all-in-one-content-restriction' );?> <a href="<?php echo admin_url( 'admin.php?page=all-in-one-content-restriction&action=new' ); ?>" class="add-new-h2"><?php _e( 'Add New', 'all-in-one-content-restriction' );?></a></h2>

				<form method="post">

					<input type="hidden" name="page" value="all_in_one_content_restriction_list_table">

					<?php
					$list_table = new AIOCR_List_Table();
					$list_table->prepare_items();
					// $list_table->search_box( 'search', 'search_id' );
					$list_table->display();
					?>

				</form>

			</div>

		<?php

	}

}

General::instance();