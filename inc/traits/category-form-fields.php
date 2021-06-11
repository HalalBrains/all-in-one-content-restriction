<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Content_Restriction;

trait Category_Form_Fields_Trait {
	
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