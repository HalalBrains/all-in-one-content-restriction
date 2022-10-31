<?php
/**
 * @author  HeyMehedi
 * @since   1.1
 * @version 1.6.4
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class AIOCR_List_Table extends \WP_List_Table {

	public $item_id = 1;

	public function get_restriction() {
		$settings = Settings::get();

		return isset( $settings['restrictions'] ) ? $settings['restrictions'] : array();
	}

	public function __construct() {
		parent::__construct( array(
			'singular' => 'aiocr',
			'plural'   => 'aiocrs',
			'ajax'     => false,
		) );
	}

	public function get_table_classes() {
		return array( 'widefat', 'fixed', 'striped', $this->_args['plural'] );
	}

	/**
	 * Message to show if no designation found
	 *
	 * @return void
	 */
	public function no_items() {
		_e( 'No items found', 'all-in-one-content-restriction' );
	}

	private function get_overview( $item ) {
		echo 'Overview Coming Soon!';
	}

	/**
	 * Default column values if no callback found
	 *
	 * @param  object  $item
	 * @param  string  $column_name
	 *
	 * @return string
	 */
	public function column_default( $item, $column_name ) {

		switch ( $column_name ) {
			case 'title':
				return $item['title'];

			case 'overview':
				return $this->get_overview( $item );

			default:
				return isset( $item->$column_name ) ? $item->$column_name : '';
		}
	}

	/**
	 * Get the column names
	 *
	 * @return array
	 */
	public function get_columns() {
		$columns = array(
			'cb'       => '<input type="checkbox" />',
			'title'    => __( 'Restriction Name', 'all-in-one-content-restriction' ),
			'overview' => __( 'Overview', 'all-in-one-content-restriction' ),

		);

		return $columns;
	}

	/**
	 * Render the designation name column
	 *
	 * @param  object  $item
	 *
	 * @return string
	 */
	public function column_title( $item ) {

		$actions           = array();
		$restriction_id    = isset( $item['restriction_id'] ) ? $item['restriction_id'] : 0;
		$title             = isset( $item['title'] ) ? $item['title'] : 0;
		$actions['edit']   = sprintf( '<a href="%s" data-id="%d" title="%s">%s</a>', admin_url( 'admin.php?page=all-in-one-content-restriction&action=edit&id=' . $restriction_id ), $restriction_id, __( 'Edit this item', 'all-in-one-content-restriction' ), __( 'Edit', 'all-in-one-content-restriction' ) );
		$actions['delete'] = sprintf( '<a href="%s" class="submitdelete" data-id="%d" title="%s">%s</a>', admin_url( 'admin.php?page=all-in-one-content-restriction&action=delete&id=' . $restriction_id ), $restriction_id, __( 'Delete this item', 'all-in-one-content-restriction' ), __( 'Delete', 'all-in-one-content-restriction' ) );

		return sprintf( '<a href="%1$s"><strong>%2$s</strong></a> %3$s', admin_url( 'admin.php?page=all-in-one-content-restriction&action=edit&id=' . $restriction_id ), $title, $this->row_actions( $actions ) );
	}

	/**
	 * Get sortable columns
	 *
	 * @return array
	 */
	public function get_sortable_columns() {
		$sortable_columns = array(
			'name' => array( 'name', true ),
		);

		return $sortable_columns;
	}

	/**
	 * Set the bulk actions
	 *
	 * @return array
	 */
	public function get_bulk_actions() {
		$actions = array(
			'trash' => __( 'Delete', 'all-in-one-content-restriction' ),
		);

		return $actions;
	}

	/**
	 * Render the checkbox column
	 *
	 * @param  object  $item
	 *
	 * @return string
	 */
	public function column_cb( $item ) {
		$restriction_id = isset( $item['restriction_id'] ) ? $item['restriction_id'] : 0;

		return sprintf(
			'<input type="checkbox" name="aiocr_id[]" value="%d" />', $restriction_id
		);
	}

	/**
	 * Set the views
	 *
	 * @return array
	 */
	public function get_views_() {
		$status_links = array();
		$base_link    = admin_url( 'admin.php?page=all-in-one-content-restriction' );

		foreach ( $this->counts as $key => $value ) {
			$class              = ( $key == $this->page_status ) ? 'current' : 'status-' . $key;
			$status_links[$key] = sprintf( '<a href="%s" class="%s">%s <span class="count">(%s)</span></a>', add_query_arg( array( 'status' => $key ), $base_link ), $class, $value['label'], $value['count'] );
		}

		return $status_links;
	}

	/**
	 * Prepare the class items
	 *
	 * @return void
	 */
	public function prepare_items() {

		$columns               = $this->get_columns();
		$hidden                = array();
		$sortable              = $this->get_sortable_columns();
		$this->_column_headers = array( $columns, $hidden, $sortable );

		$per_page          = 20;
		$current_page      = $this->get_pagenum();
		$offset            = ( $current_page - 1 ) * $per_page;
		$this->page_status = isset( $_GET['status'] ) ? sanitize_text_field( $_GET['status'] ) : '2';

		// only necessary because we have sample data
		$args = array(
			'offset' => $offset,
			'number' => $per_page,
		);

		if ( isset( $_REQUEST['orderby'] ) && isset( $_REQUEST['order'] ) ) {
			$args['orderby'] = $_REQUEST['orderby'];
			$args['order']   = $_REQUEST['order'];
		}

		$this->items = $this->get_restriction();

		$this->set_pagination_args( array(
			'total_items' => count( $this->items ),
			'per_page'    => $per_page,
		) );
	}
}