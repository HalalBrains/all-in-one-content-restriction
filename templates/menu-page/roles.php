<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

use HeyMehedi\All_In_One_Content_Restriction\Helper;

$role_names = isset( $args['role_names'] ) ? $args['role_names'] : array();
?>
<div class="part3 mb-3" id="roles_wrapper">

	<label class="form-label" for="roles"><?php esc_html_e( 'Who can see these contents?(multiple roles allowed)', 'all-in-one-content-restriction' );?></label>
	<select id="roles" class="form-control" multiple>
		<option></option>
		<?php echo Helper::get_role_names_html( $role_names ); ?>
	</select>

</div>