<?php
/*
Plugin Name: Content Restriction
Plugin URI: https://github.com/HeyMehedi/
Description: ...
Author: HeyMehedi
Author URI: https://heymehedi.com
version: 1.0
 */

namespace HeyMehedi;

class Content_Restriction {

	public static $plugin_dir;

	public function __construct() {
		self::$plugin_dir = plugin_dir_path( __FILE__ );
		$this->includes();
	}

	public function includes() {
		require_once self::$plugin_dir . 'inc/traits/init.php';
		require_once self::$plugin_dir . 'inc/helper.php';
		require_once self::$plugin_dir . 'inc/general.php';
		require_once self::$plugin_dir . 'inc/scripts.php';
	}

}

new Content_Restriction();