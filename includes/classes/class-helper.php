<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Exlac;

class Helper {

	private static function get_file_uri( $path ) {
		$file = WP_PLUGIN_URL . '/exlac' . $path;

		return $file;
	}

	private static function get_file_dir() {
		$file = WP_PLUGIN_DIR . '/exlac';

		return $file;
	}

	public static function get_img( $filename ) {
		$path = '/assets/img/' . $filename;

		return self::get_file_uri( $path );
	}

	public static function get_css( $filename ) {
		$path = '/assets/css/' . $filename . '.css';

		return self::get_file_uri( $path );
	}

	public static function get_js( $filename ) {
		$path = '/assets/js/' . $filename . '.js';

		return self::get_file_uri( $path );
	}

	public static function get_vendor_assets( $file ) {
		$path = '/assets/vendors/' . $file;

		return self::get_file_uri( $path );
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

	public static function display_items( $restriction_wise, $icon, $exclude_ids = array(), $selected_items = array(), $no_items = false ) {

		if ( $no_items && empty( $selected_items ) ) {
			return self::get_not_found_html();
		}

		if ( 'category' === $restriction_wise ) {
			$items_array = Query::get_categories( $exclude_ids, $selected_items );

			return self::get_items_html( $items_array, $icon, 'category' );
		}

		if ( 'single_post' === $restriction_wise ) {
			$items_array = Query::get_posts( $exclude_ids, $selected_items );

			return self::get_items_html( $items_array, $icon, 'single_post' );
		}

	}

	public static function get_items_html( $items_array, $icon, $wise_type ) {

		$items_list_html = '';

		if ( empty( $items_array ) ) {
			return self::get_not_found_html();
		}

		if ( 'category' === $wise_type ) {
			foreach ( $items_array->terms as $id => $name ) {
				$items_list_html .= sprintf( '<tr data-item-id="%s"><td class="text-center action"><div class="dashicons-before %s" aria-hidden="true"></div></td><td class="text-center">%s</td><td>%s</td></tr>', $id, $icon, $id, $name );
			}
		}

		if ( 'single_post' === $wise_type ) {
			foreach ( $items_array as $id ) {
				$items_list_html .= sprintf( '<tr data-item-id="%s"><td class="text-center action"><div class="dashicons-before %s" aria-hidden="true"></div></td><td class="text-center">%s</td><td>%s</td></tr>', $id, $icon, $id, get_post( $id )->post_title );
			}
		}

		return $items_list_html;
	}

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

	// Adding Suffix & Prefix for The_Title & The_Content
	public static function add_suffix_prefix( $search, $replace, $content ) {

		if ( strpos( $content, $search ) ) {
			$content = str_replace( $search, $replace, $content );
		}

		return $content;
	}

}