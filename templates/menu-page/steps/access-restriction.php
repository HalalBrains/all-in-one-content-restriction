<?php
/**
 * @author  HeyMehedi
 * @since   1.3
 * @version 1.3
 */

use HeyMehedi\All_In_One_Content_Restriction\Helper;
?>
<fieldset>

	<div class="form-card">

		<h2 class="fs-title"><?php printf( __( '<span id="post-type-dynamic-title">%s</span> access restriction', 'all-in-one-content-restriction' ), isset( $args['post_type'] ) ? $args['post_type'] : __( 'Post', 'all-in-one-content-restriction' ) );?></h2>

		<?php Helper::get_template_part( 'menu-page/selected-items', $args );?>

	</div>

	<input type="button" name="previous" class="previous action-button-previous" value="<?php esc_attr_e( 'Back', 'all-in-one-content-restriction' )?>" />
	<input type="button" name="next" class="hide-next next action-button" value="<?php esc_attr_e( 'Next', 'all-in-one-content-restriction' )?>" />
	<input type="submit" name="submit" class="hide-save action-button heymehedi-submit" value="<?php esc_attr_e( 'Save', 'all-in-one-content-restriction' );?>">

</fieldset>