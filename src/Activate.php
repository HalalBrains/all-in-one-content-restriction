<?php

/**
 * The file that defines actions on plugin activation.
 *
 * @package AllInOneContentRestriction
 */

declare(strict_types=1);

namespace AllInOneContentRestriction;

use AllInOneContentRestrictionPluginVendor\EightshiftLibs\Plugin\HasActivationInterface;

/**
 * The plugin activation class.
 *
 * @since 1.0.0
 */
class Activate implements HasActivationInterface
{

	/**
	 * Activate the plugin.
	 *
	 * @since 1.0.0
	 */
	public function activate(): void
	{
		\flush_rewrite_rules();
	}
}
