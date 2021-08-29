<?php
/**
 * @author  HeyMehedi
 * @since   1.1
 * @version 1.0
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

class Markup_Manager {

	public static $instance;
	public $preload_posts = false;
	public $conditions;
	public $condition_sort_order = array();

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public static function get_post_types_options( $selected_post_type_key = 'post' ) {
		return self::create_html_options( Query::get_post_types(), $selected_post_type_key );
	}

	public static function get_taxonomies_options( $post_type_key = 'post', $selected_taxonomy = 'category' ) {
		return self::create_html_options( Query::get_taxonomies( $post_type_key ), $selected_taxonomy );
	}

	private static function create_html_options( $items, $selected_item ) {
		$items_html = '';

		foreach ( $items as $key => $value ) {
			$items_html .= sprintf( '<option value="%s" %s>%s</option>', $key, selected( $key === $selected_item, true, false ), $value->label );
		}

		return $items_html;
	}

	// Get not found HTML
	public static function get_not_found_html() {
		return sprintf( '<tr class="not-found"><td></td> <td></td> <td> %s </td> </tr>', esc_html( Strings::get()[101] ) );
	}

	// User Roles List HTML for Settings Page
	public static function get_role_names_html( $selected_role_names ) {
		$role_names      = Query::get_role_names();
		$role_names_html = '';

		foreach ( $role_names as $key => $value ) {
			if ( in_array( $key, $selected_role_names ) ) {
				$role_names_html .= sprintf( '<option value="%s" selected>%s</option>', $key, $value );
			} else {
				$role_names_html .= sprintf( '<option value="%s">%s</option>', $key, $value );
			}
		}

		return $role_names_html;
	}

	// Get Items HTML for Table
	public static function get_items_html( $items_array, $icon, $in_type ) {

		$items_list_html = '';

		if ( empty( $items_array ) ) {
			return self::get_not_found_html();
		}

		if ( 'category' === $in_type ) {
			foreach ( $items_array->terms as $id => $name ) {
				$items_list_html .= sprintf( '<tr data-item-id="%s"><td class="text-center action"><div class="dashicons-before %s" aria-hidden="true"></div></td><td class="text-center">%s</td><td>%s</td></tr>', $id, $icon, $id, $name );
			}
		}

		if ( 'single_post' === $in_type ) {
			foreach ( $items_array as $id ) {
				$items_list_html .= sprintf( '<tr data-item-id="%s"><td class="text-center action"><div class="dashicons-before %s" aria-hidden="true"></div></td><td class="text-center">%s</td><td>%s</td></tr>', $id, $icon, $id, get_post( $id )->post_title );
			}
		}

		return $items_list_html;
	}
}