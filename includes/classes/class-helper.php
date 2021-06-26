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

}