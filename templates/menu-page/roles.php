<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

use HeyMehedi\AIO_Content_Restriction\Helper;
?>
<div class="part3 mb-3">

	<label class="form-label" for="roles"><?php esc_html_e( 'Who can see these contents?(multiple roles allowed)', 'aio-content-restriction' );?></label>
	<select id="roles" class="form-control" multiple>
		<option></option>
		<?php echo Helper::get_role_names_html( $args['role_names'] ); ?>
	</select>

</div>