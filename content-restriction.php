<?php
/*
Plugin Name: Content Restriction
Plugin URI: https://github.com/HeyMehedi/
Description: ...
Author: Mehedi Hasan
Author URI: https://heymehedi.com
version: 1.0
 */

class HeyMehedi_Content_Restriction {

	public function __construct() {
		add_action( 'category_add_form_fields', array( $this, 'pt_taxonomy_add_new_meta_field' ), 10, 2 );
		add_action( 'category_edit_form_fields', array( $this, 'category_edit_form_fields' ), 10, 2 );
		add_action( 'edited_category', array( $this, 'pt_save_taxonomy_custom_meta' ), 10, 2 );
		add_action( 'create_category', array( $this, 'pt_save_taxonomy_custom_meta' ), 10, 2 );
		add_action( 'pre_get_posts', array( $this, 'pre_get_posts' ), 10 );

		add_filter( 'the_title', array( $this, 'filter_the_title' ), 10, 2 );
		add_filter( 'get_the_excerpt', array( $this, 'filter_the_excerpt' ), 10, 2 );
	}

	public function filter_the_title( $title, $id ) {

		$user = wp_get_current_user();

		if ( has_category( $this->pre_get_posts(), $id ) ) {

			if ( ! is_user_logged_in() ) {
				return 'Sorry you can\'t see this post!';
			}

			if ( in_array( 'administrator', (array) $user->roles ) ) {
				return "The user has the admistrator role";
			}

		}

		return $title;
	}

	public function filter_the_excerpt( $post_excerpt, $post ) {

		$user = wp_get_current_user();
		$id   = $post->ID;

		if ( has_category( $this->pre_get_posts(), $id ) ) {

			if ( ! is_user_logged_in() ) {
				return "Sorry you can't see this post!";
			}

			if ( in_array( 'administrator', (array) $user->roles ) ) {
				return "The user has the admistrator role";
			}

		}

		return $post_excerpt;
	}

	public function pre_get_posts() {
		$categories           = get_categories();
		$hide_content_cat_ids = array();

		foreach ( $categories as $key => $value ) {
			$cat_id   = $categories[$key]->term_id;
			$cat_data = get_option( "taxonomy_$cat_id" );

			if ( $cat_data['show_content'] == 'yes' ) {
				array_push( $hide_content_cat_ids, $cat_id );
			}
		}

		return $hide_content_cat_ids;
	}

	public function category_edit_form_fields( $term ) {

		$t_id          = $term->term_id;
		$this->term_id = $t_id;

		// retrieve the existing value(s) for this meta field. This returns an array
		$term_meta    = get_option( "taxonomy_$t_id" );
		$show_content = $term_meta['show_content'] ? $term_meta['show_content'] : 'no';
		?>
		<tr class="form-field">
		<th scope="row" valign="top">
			<label for="term_meta[show_content]"><?php _e( 'Want to hide Title?', 'heymehedi' );?></label>
		</th>
			<td>
				<div>
					<input type="radio" id="yes" name="term_meta[show_content]" value="yes" <?php echo ( 'yes' == $show_content ) ? 'checked' : ''; ?>>
					<label for="yes">Yes</label>
				</div>

				<div>
					<input type="radio" id="no" name="term_meta[show_content]" value="no" <?php echo ( 'no' == $show_content ) ? 'checked' : ''; ?>>
					<label for="no">No</label>
				</div>

				<!-- <input type="checkbox" name="term_meta[show_content]" id="term_meta[show_content]" value="<?php echo esc_attr( $term_meta['show_content'] ) ? esc_attr( $term_meta['show_content'] ) : ''; ?>"> -->
				<p class="description"><?php printf( __( 'Choose your category icon from <a href="%s" target="_blank">Font Awesome Icons</a>. For example: <b>fa-wordpress</b>', 'heymehedi' ), 'http://fontawesome.io/icons/' );?></p>
			</td>
		</tr>



	<?php }

	public function pt_taxonomy_add_new_meta_field() {
		// this will add the custom meta field to the add new term page
		?>
		<div class="form-field">
			<label for="term_meta[show_content]"><?php _e( 'Show Title?', 'heymehedi' );?></label>
			<div>
				<input type="radio" id="yes" name="term_meta[show_content]" value="yes"
						checked>
				<label for="huey">Yes</label>
			</div>

			<div>
				<input type="radio" id="no" name="term_meta[show_content]" value="no">
				<label for="dewey">No</label>
			</div>
			<p class="description">...description...></p>
		</div>
	<?php }

	public function pt_save_taxonomy_custom_meta( $term_id ) {
		if ( isset( $_POST['term_meta'] ) ) {

			$t_id      = $term_id;
			$term_meta = get_option( "taxonomy_$t_id" );
			$cat_keys  = array_keys( $_POST['term_meta'] );

			foreach ( $cat_keys as $key ) {
				if ( isset( $_POST['term_meta'][$key] ) ) {
					$term_meta[$key] = $_POST['term_meta'][$key];
				}
			}

			// Save the option array.
			update_option( "taxonomy_$t_id", $term_meta );
		}

	}
}

( new HeyMehedi_Content_Restriction );