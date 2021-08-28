<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.1
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

	public static function display_items( $restrict_in, $icon, $exclude_ids = array(), $selected_items = array(), $no_items = false ) {

		if ( $no_items && empty( $selected_items ) ) {
			return Markup_Manager::get_not_found_html();
		}

		if ( 'category' === $restrict_in ) {
			$items_array = Query::get_categories( $exclude_ids, $selected_items );

			return Markup_Manager::get_items_html( $items_array, $icon, 'category' );
		}

		if ( 'single_post' === $restrict_in ) {
			$items_array = Query::get_posts( $exclude_ids, $selected_items );

			return Markup_Manager::get_items_html( $items_array, $icon, 'single_post' );
		}

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

	// Restriction ID from $_GET
	public static function get_restriction_id() {
		if ( isset( $_GET['action'] ) && 'edit' === $_GET['action'] ) {
			return ! empty( $_GET['id'] ) ? $_GET['id'] : '';
		}
	}

}