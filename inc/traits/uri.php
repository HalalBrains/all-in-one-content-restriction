<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

 namespace  HeyMehedi\Content_Restriction;

trait URI_Trait {

	public static function requires( $filename, $dir = false ) {
		require_once self::get_file_path( $filename, $dir );
	}

	public static function includes( $filename, $dir = false ) {
		include self::get_file_path( $filename, $dir );
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

		$template = '/' . $template . '.php';

		if ( file_exists( get_stylesheet_directory() . $template ) ) {
			$file = get_stylesheet_directory() . $template;
		} else {
			$file = get_template_directory() . $template;
		}

		require $file;
	}

	public static function get_template_content( $template ) {
		ob_start();
		get_template_part( $template );

		return ob_get_clean();
	}

	private static function get_file_path( $filename, $dir = false ) {
		if ( $dir ) {
			$child_file = get_stylesheet_directory() . '/' . $dir . '/' . $filename;

			if ( file_exists( $child_file ) ) {
				$file = $child_file;
			} else {
				$file = get_template_directory() . '/' . $dir . '/' . $filename;
			}
		} else {
			$child_file = get_stylesheet_directory() . '/inc/' . $filename;

			if ( file_exists( $child_file ) ) {
				$file = $child_file;
			} else {
				$file = get_template_directory() . '/inc/' . $filename;
			}
		}

		return $file;
	}

	private static function get_file_uri( $path ) {
		$filepath = get_stylesheet_directory() . $path;
		$file     = get_stylesheet_directory_uri() . $path;
		if ( ! file_exists( $filepath ) ) {
			$file = get_template_directory_uri() . $path;
		}

		return $file;
	}

}