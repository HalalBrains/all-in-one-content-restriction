<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Content_Restriction;

use HeyMehedi\Content_Restriction;

class Helper {

	use URI_Trait;
	use Query_Trait;

	public static $plugin_base_dir;
	public static $plugin_inc_dir;
	public static $plugin_version;
	public static $plugin_author_uri;
	public static $plugin_prefix;
	public static $plugin_options;

	public function __construct() {
		self::$plugin_base_dir   = Content_Restriction::$plugin_dir;
		self::$plugin_inc_dir    = self::$plugin_base_dir . 'inc/';

		$plugin_data             = get_plugin_data( self::$plugin_base_dir );
		self::$plugin_version    = $plugin_data['Name'];
		self::$plugin_author_uri = $plugin_data['AuthorURI'];
		self::$plugin_prefix     = 'content-restriction';
		self::$plugin_options    = 'content-restriction';
	}
}