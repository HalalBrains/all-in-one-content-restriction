<?php
/*
Plugin Name: Exlac
Plugin URI: https://github.com/HeyMehedi/exlac
Description: Exlac is a lightweight and powerful plugin that allows you to take complete control of your website’s content by restricting access to pages/posts to logged in users, specific user roles or to logged out users.
Author: HeyMehedi
Author URI: https://heymehedi.com
version: 1.0
 */

namespace HeyMehedi;

class Exlac {

	public static $base_dir;
	public static $inc_dir;
	public static $version;
	public static $author_uri;
	public static $prefix;
	public $plugin = 'exlac';

	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ), 20 );

		self::$base_dir   = plugin_dir_path( __FILE__ );
		self::$inc_dir    = self::$base_dir . '/inc/';
		$data             = $this->get_data();
		self::$version    = $data['Version'];
		self::$author_uri = $data['AuthorURI'];
		self::$prefix     = 'exlac';

		$this->includes();
	}

	public function load_textdomain() {
		load_plugin_textdomain( $this->plugin, false, self::$base_dir . 'languages' );
	}

	public function includes() {
		require_once self::$base_dir . '/includes/model/settings.php';
		require_once self::$base_dir . '/includes/model/query.php';
		require_once self::$base_dir . '/includes/classes/class-helper.php';
		require_once self::$base_dir . '/includes/classes/class-general.php';
		require_once self::$base_dir . '/includes/classes/class-ajax-handler.php';
		require_once self::$base_dir . '/includes/classes/class-scripts.php';
		require_once self::$base_dir . '/includes/classes/class-hooks.php';
		require_once self::$base_dir . '/includes/classes/class-strings.php';
	}

	public function get_data() {
		$file_path = self::$base_dir . '/exlac.php';

		return get_file_data(
			$file_path,
			array(
				'Version'   => 'Version',
				'AuthorURI' => 'Author URI',
			)
		);
	}
}

new Exlac();