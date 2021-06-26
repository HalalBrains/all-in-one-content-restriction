<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Content_Restriction;

class Helper {

	private static function get_file_uri( $path ) {
		$file = WP_PLUGIN_URL . '/content-restriction' . $path;

		return $file;
	}

	private static function get_file_dir() {
		$file = WP_PLUGIN_DIR . '/content-restriction';

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

		// if ( file_exists( self::get_file_dir() . $template ) ) {
		// 	$file = self::get_file_dir() . $template;
		// }

		require $file;
	}

	public static function display_items( $restriction_wise, $icon, $exclude_ids = array(), $selected_items = array(), $no_items = false ) {

		if ( $no_items && empty( $selected_items ) ) {
			return __( '<tr> Sorry, no items found!</tr>', 'content-restriction' );
		}

		if ( 'category' === $restriction_wise ) {
			$items_array = Query::get_categories( $exclude_ids, $selected_items );
			return self::get_items_html( $items_array, $icon, 'category' );
		}

		if ( 'single-post' === $restriction_wise ) {
			$items_array = Query::get_posts( $exclude_ids, $selected_items );
			return self::get_items_html( $items_array, $icon, 'single-post' );
		}

	}

	public static function get_items_html( $items_array, $icon, $wise_type ) {

		$items_list_html = '';

		if ( ! $items_array ) {
			return __( '<tr class="not-found"> <td></td><td></td> <td>Sorry, no items found! </td></tr>', 'content-restriction' );
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