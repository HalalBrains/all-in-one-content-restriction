<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

$protection_type = isset( $args['protection_type'] ) ? $args['protection_type'] : 'override_contents';
?>
<div class="part2 mb-3">

	<label class="form-label" for="protection_type"><?php esc_html_e( 'Choose how to protect your content', 'all-in-one-content-restriction' );?></label>
	<select id="protection_type" class="form-select form-control">
		<option value="override_contents" <?php selected( 'override_contents' == $protection_type );?>><?php esc_html_e( 'Override Contents', 'all-in-one-content-restriction' );?></option>
		<option value="login_and_back" <?php selected( 'login_and_back' == $protection_type );?>><?php esc_html_e( 'Login and Back', 'all-in-one-content-restriction' );?></option>
		<option value="redirect" <?php selected( 'redirect' == $protection_type );?>><?php esc_html_e( 'Redirect', 'all-in-one-content-restriction' );?></option>
	</select>

</div>