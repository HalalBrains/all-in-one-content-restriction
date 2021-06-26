<?php
/*
Plugin Name: Content Restriction
Plugin URI: https://github.com/HeyMehedi/content-restriction
Description: Content Restriction is a lightweight and powerful plugin that allows you to take complete control of your website’s content by restricting access to pages/posts to logged in users, specific user roles or to logged out users.
Author: HeyMehedi
Author URI: https://heymehedi.com
version: 1.0
 */

namespace HeyMehedi;

class Content_Restriction {

	public static $base_dir;
	public static $inc_dir;
	public static $version;
	public static $author_uri;
	public static $prefix;
	public static $options;
	public static $options_name;

	public function __construct() {

		self::$base_dir = WP_PLUGIN_DIR . '/content-restriction';
		self::$inc_dir  = self::$base_dir . '/inc/';

		$data               = $this->get_data();
		self::$version      = $data['Version'];
		self::$author_uri   = $data['AuthorURI'];
		self::$prefix       = 'content-restriction';
		self::$options_name = 'heymehdi_content_restriction';

		$this->includes();
		$this->set_option();

	}

	public function includes() {
		require_once self::$base_dir . '/includes/classes/class-helper.php';
		require_once self::$base_dir . '/includes/classes/class-controller.php';
		require_once self::$base_dir . '/includes/classes/class-scripts.php';

		require_once self::$base_dir . '/includes/model/query.php';
		require_once self::$base_dir . '/includes/model/update.php';
	}

	public function get_data() {
		$file_path = self::$base_dir . '/content-restriction.php';

		return get_file_data( $file_path, array( 'Version' => 'Version', 'AuthorURI' => 'Author URI' ) );
	}

	private function set_option() {
		self::$options = get_option( Content_Restriction::$options_name, array() );
	}
}

new Content_Restriction();