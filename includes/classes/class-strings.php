<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Exlac;

class Strings {

	protected static $instance = null;

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public static function get() {
		return array(
			100 => __( 'Content Restriction', 'exlac' ),
			101 => __( 'Sorry, no items found!', 'exlac' ),
			102 => __( 'Type', 'exlac' ),
			103 => __( 'Restrict in', 'exlac' ),
			104 => __( 'Type the title or ID', 'exlac' ),
			105 => __( 'Add', 'exlac' ),
			106 => __( 'ID', 'exlac' ),
			107 => __( 'Title', 'exlac' ),
			108 => __( 'Save Changes', 'exlac' ),
			109 => __( 'Selected Items', 'exlac' ),
			110 => __( 'Who can see restricted content?', 'exlac' ),
			111 => __( 'Posts', 'exlac' ),
			112 => __( 'Category', 'exlac' ),
			113 => __( 'Single Post', 'exlac' ),
			114 => __( 'Search Here...', 'exlac' ),
			115 => __( 'Replace Default Description', 'exlac' ),
			116 => __( 'Replace Default Title', 'exlac' ),
			117 => __( 'Use the_title by %%title%%', 'exlac' ),
			118 => __( 'Prefix %%title%% Suffix', 'exlac' ),
			119 => __( 'Use the_content by %%content%%', 'exlac' ),
			120 => __( 'Drop', 'exlac' ),
			121 => __( 'Replace Default Excerpt', 'exlac' ),
			122 => __( 'Use the_content by %%excerpt%%', 'exlac' ),
			123 => __( 'Saved Successfully', 'exlac' ),
			124 => __( 'No changes made', 'exlac' ),

		);
	}
}

Strings::instance();