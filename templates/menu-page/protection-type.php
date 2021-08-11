<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */
?>
<div class="part2 mb-3">

	<label class="form-label" for="protection_type"><?php esc_html_e( 'Choose how to protect your content', 'aio-content-restriction' );?></label>
	<select id="protection_type" class="form-select form-control">
		<option value="override_contents" <?php selected( 'override_contents' == $args['protection_type'] );?>><?php esc_html_e( 'Override Contents', 'aio-content-restriction' );?></option>
		<option value="login_and_back" <?php selected( 'login_and_back' == $args['protection_type'] );?>><?php esc_html_e( 'Login and Back', 'aio-content-restriction' );?></option>
		<option value="redirect" <?php selected( 'redirect' == $args['protection_type'] );?>><?php esc_html_e( 'Redirect', 'aio-content-restriction' );?></option>
	</select>

</div>