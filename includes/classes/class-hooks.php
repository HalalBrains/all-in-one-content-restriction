<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Content_Restriction;

use HeyMehedi\Content_Restriction\Settings;

class Hooks {

	protected static $instance = null;
	private $settings;

	public function __construct() {
		$this->settings = Settings::get();

		add_filter( 'the_title', array( $this, 'the_title' ), 10, 2 );
		// add_filter( 'get_the_excerpt', array( $this, 'filter_the_excerpt' ), 11, 2 );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function the_title( $title, $id ) {

		$current_user  = wp_get_current_user();
		$can_see_users = $this->settings['role_names'];

		if ( has_category( $this->pre_get_posts(), $id ) ) {

			if ( in_array( 'administrator', (array) $user->roles ) || in_array( 'member', (array) $user->roles ) ) {
				return $title;
			}

			return '<span class="blur">' . $title . '</span>';
		}

		return $title;
	}
}

Hooks::instance();