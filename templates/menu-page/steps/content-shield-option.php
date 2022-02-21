<?php
/**
 * @author  HeyMehedi
 * @since   1.3
 * @version 1.5
 */

use HeyMehedi\All_In_One_Content_Restriction\Helper;
?>
<fieldset>

	<div class="form-card">

		<h2 class="fs-title"><?php esc_attr_e( 'Content shield option', 'all-in-one-content-restriction' );?></h2>
		
		<?php Helper::get_template_part( 'menu-page/protections/override-contents', $args );?>
		<?php Helper::get_template_part( 'menu-page/protections/redirect', $args );?>
		<?php Helper::get_template_part( 'menu-page/protections/blur', $args );?>
		<?php Helper::get_template_part( 'menu-page/protections/obfuscate', $args );?>
		
		<input type="hidden" value="<?php echo esc_attr( $_GET['action'] ); ?>" id="heymehedi-action" data-restriction-id="<?php echo esc_attr( Helper::get_restriction_id() ); ?>">

	</div>

	<input type="button" name="previous" class="previous action-button-previous" value="<?php esc_attr_e( 'Back', 'all-in-one-content-restriction' )?>" />
	<input type="submit" name="submit" class="action-button heymehedi-submit" value="<?php esc_attr_e( 'Save', 'all-in-one-content-restriction' );?>">

</fieldset>