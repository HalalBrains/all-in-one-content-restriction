<?php
/**
 * @author  HeyMehedi
 * @since   1.1
 * @version 1.6.4
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

	public static function create_html_options( $items, $selected_item ) {
		$items_html = sprintf( '<option value="" selected disabled hidden>%s</option>', esc_html__( 'Select your option', 'all-in-one-content-restriction' ) );

		foreach ( $items as $key => $value ) {
			$items_html .= sprintf( '<option value="%s" %s>%s</option>', $key, selected( $key === $selected_item, true, false ), $value['label'] );
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

	// User Roles List HTML for Settings Page
	public static function get_specified_user_html( $selected_role_names ) {
		$users      = Query::get_users();
		$users_html = '';

		foreach ( $users as $key => $value ) {
			$display_name = $value->display_name;
			$user_login   = $value->user_login;

			if ( in_array( $user_login, $selected_role_names ) ) {
				$users_html .= sprintf( '<option value="%s" selected>%s (%s)</option>', $user_login, $display_name, $user_login );
			} else {
				$users_html .= sprintf( '<option value="%s">%s (%s)</option>', $user_login, $display_name, $user_login );
			}
		}

		return $users_html;
	}

	// Blur & Obfuscate Apply List HTML for Settings Page
	public static function apply_to_html( $selected_items ) {
		$apply_to_arr = array(
			'the_title'   => __( 'Title', 'all-in-one-content-restriction' ),
			'the_excerpt' => __( 'Excerpt', 'all-in-one-content-restriction' ),
			'the_content' => __( 'Descriptions', 'all-in-one-content-restriction' ),
		);
		$apply_to_html = '';

		foreach ( $apply_to_arr as $key => $value ) {
			if ( in_array( $key, $selected_items ) ) {
				$apply_to_html .= sprintf( '<option value="%s" selected>%s</option>', $key, $value );
			} else {
				$apply_to_html .= sprintf( '<option value="%s">%s</option>', $key, $value );
			}
		}

		return $apply_to_html;
	}

	// Get Items HTML for Table
	public static function get_items_html( $items_array, $icon, $in_type ) {

		$items_list_html = '';

		if ( empty( $items_array ) ) {
			return self::get_not_found_html();
		}

		if ( 'taxonomy' === $in_type ) {
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

	public static function display_taxonomy_single_items_html( $post_type, $restrict_in, $icon, $exclude_ids = array(), $selected_items = array(), $no_items = false ) {
		$items_list_html = '';

		if ( $no_items && empty( $selected_items ) ) {
			return self::get_not_found_html();
		}

		if ( 'selected_single_items' == $restrict_in ) {
			$single_items = Query::get_posts( $post_type, $exclude_ids, $selected_items );

			foreach ( $single_items as $id ) {
				$items_list_html .= sprintf( '<tr data-item-id="%s"><td class="text-center action"><div class="dashicons-before %s" aria-hidden="true"></div></td><td class="text-center">%s</td><td>%s</td></tr>', esc_attr( $id ), esc_attr( $icon ), esc_attr( $id ), esc_html( get_post( $id )->post_title ) );
			}

			return $items_list_html;
		}

		$terms = Query::get_terms( $restrict_in, $exclude_ids, $selected_items );
		if ( isset( $terms->errors ) || isset( $terms->error_data ) || ! $terms ) {
			return self::get_not_found_html();
		} else {
			foreach ( $terms as $key => $value ) {
				$items_list_html .= sprintf( '<tr data-item-id="%s"><td class="text-center action"><div class="dashicons-before %s" aria-hidden="true"></div></td><td class="text-center">%s</td><td>%s</td></tr>', esc_attr( $value->term_id ), esc_attr( $icon ), esc_attr( $value->term_id ), esc_attr( $value->name ) );
			}

			return $items_list_html;
		}
	}
}