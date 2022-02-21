<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.5
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

		$content = stripslashes( wp_specialchars_decode( $content, ENT_QUOTES, 'UTF-8' ) );

		if ( strpos( $content, $search ) ) {
			$content = str_replace( $search, $replace, $content );
		}

		return $content;
	}

	// Restriction ID from $_GET
	public static function get_restriction_id() {
		if ( isset( $_GET['action'] ) && 'edit' === $_GET['action'] ) {
			return ! empty( $_GET['id'] ) ? $_GET['id'] : '';
		}
	}

	// Get Current Restrict In Title
	public static function get_current_restrict_in_label( $post_type, $restrict_in ) {
		$restrict_in_list          = Post_Type_Taxonomies::get_restrict_in_options( $post_type, $restrict_in, false );
		$current_restrict_in_label = isset( $restrict_in_list[$restrict_in]['label'] ) ? $restrict_in_list[$restrict_in]['label'] : esc_html__( 'Any Post has selected Categories', 'all-in-one-content-restriction' );

		return $current_restrict_in_label;
	}

	// Get Random Text
	public static function get_random_text( $content ) {
		$return = '';
		$chars  = preg_split( '/ /', $content, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE );

		foreach ( $chars as $key => $value ) {

			if ( strpos( $value, 'href' ) === 0 ) {
				$return .= sprintf( ' <a href="%s">Some Resource</a> ', site_url() );
				continue;
			}

			if ( strlen( $value ) > 4 ) {
				$return .= $value . ' ';
				continue;
			}

			if ( strpos( $value, '<' ) != false || strpos( $value, '/>' ) != false ) {
				$return .= $value . ' ';
				continue;
			}

			$return .= self::generate_random_string() . ' ';
		}

		return $return;
	}

	public static function generate_random_string() {
		$length            = rand( 0, 8 );
		$characters        = 'abcdefghijklmnopqrstuvwxyz';
		$characters_length = strlen( $characters );
		$random_string     = '';

		for ( $i = 0; $i < $length; $i++ ) {
			$random_string .= $characters[rand( 0, $characters_length - 1 )];
		}

		return $random_string;
	}
}