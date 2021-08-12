<?php
/*
Plugin Name: All in One Content Restriction
Plugin URI: https://github.com/HeyMehedi/all-in-one-content-restriction
Description: All in One Content Restriction is a lightweight and powerful plugin that allows you to take complete control of your website’s content by restricting access to pages/posts to logged in users, specific user roles or to logged out users.
Author: HeyMehedi
Author URI: https://heymehedi.com
version: 1.0
Text Domain: all-in-one-content-restriction
 */

namespace HeyMehedi;

class All_In_One_Content_Restriction {

	public static $base_dir;
	public static $base_url;
	public static $inc_dir;
	public static $version;
	public static $author_uri;
	public static $prefix;
	public $plugin = 'all-in-one-content-restriction';

	public function __construct() {

		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ), 20 );

		self::$base_dir   = plugin_dir_path( __FILE__ );
		self::$base_url   = plugin_dir_url( __FILE__ );
		self::$inc_dir    = self::$base_dir . '/inc/';
		$data             = $this->get_data();
		self::$version    = $data['Version'];
		self::$author_uri = $data['AuthorURI'];
		self::$prefix     = 'all-in-one-content-restriction';

		$this->includes();
	}

	public function load_textdomain() {
		load_plugin_textdomain( $this->plugin, false, self::$base_dir . 'languages' );
	}

	public function includes() {
		require_once self::$base_dir . '/includes/model/Settings.php';
		require_once self::$base_dir . '/includes/model/Query.php';
		require_once self::$base_dir . '/includes/classes/class-helper.php';
		require_once self::$base_dir . '/includes/classes/class-protection-base.php';
		require_once self::$base_dir . '/includes/classes/class-general.php';
		require_once self::$base_dir . '/includes/classes/class-ajax-handler.php';
		require_once self::$base_dir . '/includes/classes/class-scripts.php';
		require_once self::$base_dir . '/includes/classes/class-override-contents.php';
		require_once self::$base_dir . '/includes/classes/class-login-and-back.php';
		require_once self::$base_dir . '/includes/classes/class-redirection.php';
		require_once self::$base_dir . '/includes/classes/class-strings.php';
	}

	public function get_data() {
		$file_path = self::$base_dir . '/all-in-one-content-restriction.php';

		return get_file_data(
			$file_path,
			array(
				'Version'   => 'Version',
				'AuthorURI' => 'Author URI',
			)
		);
	}
}

new All_In_One_Content_Restriction();