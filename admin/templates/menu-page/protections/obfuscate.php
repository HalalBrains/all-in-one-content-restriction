<?php
/**
 * @author  HeyMehedi
 * @since   1.5
 * @version 1.5
 */

use HeyMehedi\All_In_One_Content_Restriction\Markup_Manager;

$selected_obfuscate_items = isset( $args['obfuscate_apply_to'] ) ? $args['obfuscate_apply_to'] : array();
?>
<div class="part4 mb-3" id="obfuscate">

	<label for="obfuscate_apply_to" class="form-label">
		<?php esc_html_e( 'Apply to', 'all-in-one-content-restriction' );?>
	</label>
	<select id="obfuscate_apply_to" class="form-control" multiple>
		<?php echo Markup_Manager::apply_to_html( $selected_obfuscate_items ); ?>
	</select>

</div>