<?php

/**
 * @link       https://heymehedi.com
 * @since      1.0.0
 *
 * @package    HeyMehedi_Hide_Admin_Notices
 * @subpackage HeyMehedi_Hide_Admin_Notices/includes
 */

/**
 * @since      1.0.0
 * @package    HeyMehedi_Hide_Admin_Notices
 * @subpackage HeyMehedi_Hide_Admin_Notices/includes
 * @author     HeyMehedi <hi@heymehedi.com>
 */
class HeyMehedi_Hide_Admin_Notices {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      HeyMehedi_Hide_Admin_Notices_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $plugin_name The string used to uniquely identify this plugin.
	 */
	public $plugin_name = 'all-in-one-content-restriction';

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $version The current version of the plugin.
	 */
	public $version = '1.2.2';

	/**
	 * Initialize the class.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->define_constants();
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
	}

	/**
	 * Define plugin constants.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_constants() {
		define( 'HEYMEHEDI_HIDE_ADMIN_NOTICES_ABSPATH', dirname( HEYMEHEDI_HIDE_ADMIN_NOTICES_PLUGIN_FILE ) . '/' );
		define( 'HEYMEHEDI_HIDE_ADMIN_NOTICES_BASENAME', plugin_basename( HEYMEHEDI_HIDE_ADMIN_NOTICES_PLUGIN_FILE ) );
		define( 'HEYMEHEDI_HIDE_ADMIN_NOTICES_BASEURL', plugin_dir_url( HEYMEHEDI_HIDE_ADMIN_NOTICES_PLUGIN_FILE ) );
		define( 'HEYMEHEDI_HIDE_ADMIN_NOTICES_VERSION', $this->version );
		define( 'HEYMEHEDI_HIDE_ADMIN_NOTICES_NAME', $this->plugin_name );
		define( 'HEYMEHEDI_HIDE_ADMIN_NOTICES_DONATE_LINK', 'https://www.buymeacoffee.com/pontetlabs' );
		define( 'HEYMEHEDI_HIDE_ADMIN_NOTICES_RATE_LINK', 'https://wordpress.org/support/plugin/hide-admin-notices/reviews/#new-post' );
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		require_once HEYMEHEDI_HIDE_ADMIN_NOTICES_ABSPATH . 'includes/class-hide-admin-notices-loader.php';
		require_once HEYMEHEDI_HIDE_ADMIN_NOTICES_ABSPATH . 'includes/class-hide-admin-notices-i18n.php';
		require_once HEYMEHEDI_HIDE_ADMIN_NOTICES_ABSPATH . 'includes/class-hide-admin-notices-admin.php';

		$this->loader = new HeyMehedi_Hide_Admin_Notices_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {
		$plugin_i18n = new HeyMehedi_Hide_Admin_Notices_i18n();
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to the admin area.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$plugin_admin = new HeyMehedi_Hide_Admin_Notices_Admin();
		$this->loader->add_action( 'plugin_row_meta', $plugin_admin, 'plugin_row_meta', 20, 2 );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts', 1 );
		$this->loader->add_action( 'admin_notices', $plugin_admin, 'admin_notices', 1 );
		$this->loader->add_filter( 'plugin_action_links_' . HEYMEHEDI_HIDE_ADMIN_NOTICES_BASENAME, $plugin_admin, 'plugin_action_links' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}
}
