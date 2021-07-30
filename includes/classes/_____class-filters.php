<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Exlac;

trait Filters_Trait {
	
	public function filter_the_title( $title, $id ) {

		$user = wp_get_current_user();

		if ( has_category( $this->pre_get_posts(), $id ) ) {

			if ( ! is_user_logged_in() ) {
				return '<span class="blur">' . $title . '</span>';
			}

			if ( in_array( 'administrator', (array) $user->roles ) || in_array( 'member', (array) $user->roles ) ) {
				return $title;
			}

			return '<span class="blur">' . $title . '</span>';
		}

		return $title;
	}

	public function filter_the_excerpt( $post_excerpt, $post ) {

		$user = wp_get_current_user();

		if ( has_category( $this->pre_get_posts(), $post->ID ) ) {

			if ( ! is_user_logged_in() ) {
				return "<div class='blur'>" . $post_excerpt . "</div>";
			}

			if ( in_array( 'administrator', (array) $user->roles ) || in_array( 'member', (array) $user->roles ) ) {
				return $post_excerpt;
			}

			return " " . $post_excerpt . " ";
		}

		return $post_excerpt;
	}

}