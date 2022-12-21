<?php

/**
 * Plugin Name: All In One Content Restriction
 * Plugin URI: https://github.com/HalalBrains/all-in-one-content-restriction/
 * Description: All in One Content Restriction - A simple and user-friendly plugin to restrict users / visitors from viewing posts by restricting access, as simple as that.
 * Author: HalalBrains
 * Author URI: https://profiles.wordpress.org/halalbrains/
 * Version: 2.0.0
 * License: GPLv2 or later
 * Text Domain: all-in-one-content-restriction
 * Domain Path: /languages
 *
 * @package AllInOneContentRestriction
 */

declare(strict_types=1);

namespace AllInOneContentRestriction;

use AllInOneContentRestriction\Main\Main;
use AllInOneContentRestrictionPluginVendor\EightshiftLibs\Cli\Cli;

/**
 * If this file is called directly, abort.
 */
if (! \defined('WPINC')) {
	die;
}

/**
 * Include the autoloader so we can dynamically include the rest of the classes.
 */
$loader = require __DIR__ . '/vendor/autoload.php';

/**
 * The code that runs during plugin activation.
 */
register_activation_hook(
	__FILE__,
	function () {
		PluginFactory::activate();
	}
);

/**
 * The code that runs during plugin deactivation.
 */
register_deactivation_hook(
	__FILE__,
	function () {
		PluginFactory::deactivate();
	}
);


/**
 * Begins execution of the theme.
 *
 * Since everything within the theme is registered via hooks,
 * then kicking off the theme from this point in the file does
 * not affect the page life cycle.
 */
if (class_exists(Main::class)) {
	(new Main($loader->getPrefixesPsr4(), __NAMESPACE__))->register();
}

/**
 * Run all WPCLI commands.
 */
if (class_exists(Cli::class)) {
	(new Cli())->load('boilerplate');
}
