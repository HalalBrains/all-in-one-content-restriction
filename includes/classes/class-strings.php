<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Content_Restriction;

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
			100 => __( 'Content Restriction', 'content-restriction' ),
			101 => __( 'Sorry, no items found!', 'content-restriction' ),
			102 => __( 'Type', 'content-restriction' ),
			103 => __( ' Restrict in', 'content-restriction' ),
			104 => __( 'Type the title or ID', 'content-restriction' ),
			105 => __( 'Add', 'content-restriction' ),
			106 => __( 'ID', 'content-restriction' ),
			107 => __( 'Title', 'content-restriction' ),
			108 => __( 'Save Changes', 'content-restriction' ),
			109 => __( 'Selected Items', 'content-restriction' ),
			110 => __( 'Who can see restricted content?', 'content-restriction' ),
			111 => __( 'Posts', 'content-restriction' ),
			112 => __( 'Category', 'content-restriction' ),
			113 => __( 'Single Post', 'content-restriction' ),
			114 => __( 'Search Here...', 'content-restriction' ),
			115 => __( 'Replace Default Description', 'content-restriction' ),
			116 => __( 'Replace Default Title', 'content-restriction' ),
			117 => __( 'Use the_title by %%title%%', 'content-restriction' ),
			118 => __( 'Prefix %%title%% Suffix', 'content-restriction' ),
			119 => __( 'Use the_content by %%content%%', 'content-restriction' ),
			120 => __( 'Drop', 'content-restriction' ),
		);
	}
}

Strings::instance();