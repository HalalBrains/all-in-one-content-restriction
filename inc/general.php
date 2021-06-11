<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Content_Restriction;

class General_Setup {

	use Filters_Trait;
	use Actions_Trait;
	use Category_Form_Fields_Trait;

	protected static $instance = null;

	public function __construct() {
		add_action( 'category_add_form_fields', array( $this, 'pt_taxonomy_add_new_meta_field' ), 10, 2 );
		add_action( 'category_edit_form_fields', array( $this, 'category_edit_form_fields' ), 10, 2 );
		add_action( 'edited_category', array( $this, 'pt_save_taxonomy_custom_meta' ), 10, 2 );
		add_action( 'create_category', array( $this, 'pt_save_taxonomy_custom_meta' ), 10, 2 );
		add_action( 'pre_get_posts', array( $this, 'pre_get_posts' ), 10 );

		add_filter( 'the_title', array( $this, 'filter_the_title' ), 10, 2 );
		add_filter( 'get_the_excerpt', array( $this, 'filter_the_excerpt' ), 11, 2 );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
	
}

General_Setup::instance();