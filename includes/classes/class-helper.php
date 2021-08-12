<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\All_In_One_Content_Restriction;

use HeyMehedi\All_In_One_Content_Restriction;

class Helper {

	public static function get_file_uri( $path ) {
		$file = All_In_One_Content_Restriction::$base_url . $path;

		return $file;
	}

	public static function get_file_dir() {
		$file = All_In_One_Content_Restriction::$base_dir;

		return $file;
	}

	public static function get_template_part( $template, $args = array() ) {

		if ( is_array( $args ) ) {
			extract( $args );
		}

		$template = '/templates/' . $template . '.php';

		$file = self::get_file_dir() . $template;

		require $file;
	}

	public static function get_not_found_html() {
		return sprintf( '<tr class="not-found"><td></td> <td></td> <td> %s </td> </tr>', esc_html( Strings::get()[101] ) );
	}

	public static function display_items( $restrict_in, $icon, $exclude_ids = array(), $selected_items = array(), $no_items = false ) {

		if ( $no_items && empty( $selected_items ) ) {
			return self::get_not_found_html();
		}

		if ( 'category' === $restrict_in ) {
			$items_array = Query::get_categories( $exclude_ids, $selected_items );

			return self::get_items_html( $items_array, $icon, 'category' );
		}

		if ( 'single_post' === $restrict_in ) {
			$items_array = Query::get_posts( $exclude_ids, $selected_items );

			return self::get_items_html( $items_array, $icon, 'single_post' );
		}

	}

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

	// Displaying Text Editor to Modify The_Content
	public static function get_text_editor( $content = '' ) {
		$editor_id = 'heymehedi_custom_editor';
		$settings  = array(
			'media_buttons' => false,
			'textarea_rows' => 10,

		);

		return wp_editor( $content, $editor_id, $settings );
	}

	// Adding Suffix & Prefix for The_Title, The_Excerpt & The_Content
	public static function add_suffix_prefix( $search, $replace, $content ) {

		if ( strpos( $content, $search ) ) {
			$content = str_replace( $search, $replace, $content );
		}

		return $content;
	}

}