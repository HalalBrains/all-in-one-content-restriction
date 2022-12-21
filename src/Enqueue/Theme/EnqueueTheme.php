<?php

/**
 * The Theme/Frontend Enqueue specific functionality.
 *
 * @package AllInOneContentRestriction\Enqueue\Theme
 */

declare(strict_types=1);

namespace AllInOneContentRestriction\Enqueue\Theme;

use AllInOneContentRestriction\Config\Config;
use AllInOneContentRestrictionPluginVendor\EightshiftLibs\Manifest\ManifestInterface;
use AllInOneContentRestrictionPluginVendor\EightshiftLibs\Enqueue\Theme\AbstractEnqueueTheme;

/**
 * Class EnqueueTheme
 */
class EnqueueTheme extends AbstractEnqueueTheme
{
	/**
	 * Create a new admin instance.
	 *
	 * @param ManifestInterface $manifest Inject manifest which holds data about assets from manifest.json.
	 */
	public function __construct(ManifestInterface $manifest)
	{
		$this->manifest = $manifest;
	}

	/**
	 * Register all the hooks
	 *
	 * @return void
	 */
	public function register(): void
	{
		\add_action('wp_enqueue_scripts', [$this, 'enqueueStyles'], 10);
		\add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);
	}

	/**
	 * Method that returns assets name used to prefix asset handlers.
	 *
	 * @return string
	 */
	public function getAssetsPrefix(): string
	{
		return Config::getProjectName();
	}

	/**
	 * Method that returns assets version for versioning asset handlers.
	 *
	 * @return string
	 */
	public function getAssetsVersion(): string
	{
		return Config::getProjectVersion();
	}
}
