<?php
/**
 * Plugin Name: All in One Content Restriction
 * Plugin URI: https://github.com/HeyMehedi/all-in-one-content-restriction
 * Description: All in One Content Restriction - A simple and user-friendly plugin to restrict users / visitors from viewing posts by restricting access, as simple as that.
 * Author: HeyMehedi
 * Author URI: https://heymehedi.com
 * version: 1.5
 * License: GPLv2 or later
 * Text Domain: all-in-one-content-restriction
 * Domain Path: /languages
 */

namespace HeyMehedi;

defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

if ( ! class_exists( 'All_In_One_Content_Restriction' ) ) {
	class All_In_One_Content_Restriction {

		private static $instance;
		public static $base_dir;
		public static $base_url;
		public static $inc_dir;
		public static $version;
		public static $author_uri;
		public static $prefix;

		public static function instance() {

			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof All_In_One_Content_Restriction ) ) {
				self::$instance = new All_In_One_Content_Restriction();
				self::$instance->init();
			}

			return self::$instance;
		}

		private function __construct() {}

		public function init() {
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
			load_plugin_textdomain( 'all-in-one-content-restriction', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		}

		public function includes() {
			require_once self::$base_dir . '/includes/model/Settings.php';
			require_once self::$base_dir . '/includes/model/Query.php';

			require_once self::$base_dir . '/includes/classes/class-helper.php';
			require_once self::$base_dir . '/includes/classes/class-markup-manager.php';
			require_once self::$base_dir . '/includes/classes/class-post-type-taxonomies.php';

			require_once self::$base_dir . '/includes/classes/class-list-table.php';
			require_once self::$base_dir . '/includes/classes/class-general.php';

			require_once self::$base_dir . '/includes/classes/class-ajax-handler.php';
			require_once self::$base_dir . '/includes/classes/class-scripts.php';

			require_once self::$base_dir . '/includes/classes/protections/class-protection-base.php';
			require_once self::$base_dir . '/includes/classes/protections/class-override-contents.php';
			require_once self::$base_dir . '/includes/classes/protections/class-login-and-back.php';
			require_once self::$base_dir . '/includes/classes/protections/class-blur.php';
			require_once self::$base_dir . '/includes/classes/protections/class-obfuscate.php';

			require_once self::$base_dir . '/includes/classes/protections/class-redirection.php';

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

	All_In_One_Content_Restriction::instance();
}