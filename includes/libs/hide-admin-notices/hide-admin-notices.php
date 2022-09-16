<?php
/**
 * @link              https://heymehedi.com
 * @since             1.0.0
 * @package           HeyMehedi_Hide_Admin_Notices
 *
 * Version:           1.2.2
 * Author:            HeyMehedi
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Define path to this file constant.
 *
 * @since    1.0.0
 */
define( 'HEYMEHEDI_HIDE_ADMIN_NOTICES_PLUGIN_FILE', __FILE__ );

// echo HEYMEHEDI_HIDE_ADMIN_NOTICES_PLUGIN_FILE;

require plugin_dir_path( HEYMEHEDI_HIDE_ADMIN_NOTICES_PLUGIN_FILE ) . 'includes/class-hide-admin-notices.php';

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
function heymehedi_run_hide_admin_notices() {
	$plugin = new HeyMehedi_Hide_Admin_Notices();
	$plugin->run();
}

heymehedi_run_hide_admin_notices();