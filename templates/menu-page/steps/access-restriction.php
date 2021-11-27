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

		<h2 class="fs-title">Post / Page access restriction </h2>

		<?php Helper::get_template_part( 'menu-page/selected-items', $args );?>

	</div>

	<input type="button" name="previous" class="previous action-button-previous" value="<?php esc_attr_e( 'Back', 'all-in-one-content-restriction' )?>" />
	<input type="button" name="next" class="next action-button" value="<?php esc_attr_e( 'Next', 'all-in-one-content-restriction' )?>" />

</fieldset>