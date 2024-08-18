<?php
/**
 * Plugin Name: CR
 * Plugin URI: https://wordpress.org/plugins/content-restriction/
 * Description: CR
 * Author: HeyMehedi
 * Author URI: https://profiles.wordpress.org/heymehedi/
 * Version: 1.7.0
 * Tested up to: 6.6
 * Requires PHP: 7.4
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
			add_action( 'plugins_loaded', [$this, 'load_textdomain'], 20 );

			self::$base_dir   = plugin_dir_path( __FILE__ );
			self::$base_url   = plugin_dir_url( __FILE__ );
			self::$inc_dir    = self::$base_dir . '/inc/';
			$data             = $this->get_data();
			self::$version    = $data['Version'];
			self::$author_uri = $data['AuthorURI'];
			self::$prefix     = 'all-in-one-content-restriction';

			add_action( 'admin_notices', [$this, '_admin_notice'] );

			$this->includes();
		}

		public function _admin_notice() {
			?>
			<div class="notice notice-info is-dismissible">
				<h1>Important Notice</h1>
				<p>Your installed <b>CR</b> plugin has been superseded by a new and improved solution! We’ve developed a more advanced plugin that offers better features, enhanced performance, and ongoing support.</p>
				<p><a href="https://wordpress.org/plugins/content-restriction/" target="_blank">All in one content restriction</a> is the recommended replacement of this plugin. It comes with more customization options, improved compatibility, and a more user-friendly interface.</p>
				<p>We strongly encourage you to switch to <a href="https://wordpress.org/plugins/content-restriction/" target="_blank">All in one content restriction</a> for an upgraded experience.</p>
			</div>
		<?php }

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

			require_once self::$base_dir . '/includes/classes/protections/class-protection-manager.php';
			require_once self::$base_dir . '/includes/classes/protections/class-redirection.php';
			require_once self::$base_dir . '/includes/classes/protections/class-login-and-back.php';

			require_once self::$base_dir . '/includes/classes/protections/class-override-contents.php';
			require_once self::$base_dir . '/includes/classes/protections/class-obfuscate.php';
			require_once self::$base_dir . '/includes/classes/protections/class-blur.php';

			require_once self::$base_dir . '/includes/classes/protections/class-hide-from-loop.php';

			require_once self::$base_dir . '/includes/classes/class-strings.php';

			// if ( isset( $_REQUEST['page'] ) && 'all-in-one-content-restriction' === $_REQUEST['page'] && ! class_exists( 'Hide_Admin_Notices' ) ) {
			// 	require_once self::$base_dir . '/includes/libs/hide-admin-notices/hide-admin-notices.php';
			// }
		}

		public function get_data() {
			$file_path = self::$base_dir . '/all-in-one-content-restriction.php';

			return get_file_data(
				$file_path,
				[
					'Version'   => 'Version',
					'AuthorURI' => 'Author URI',
				]
			);
		}

	}

	All_In_One_Content_Restriction::instance();
}