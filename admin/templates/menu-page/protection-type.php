<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.6.4
 */

$protection_type = isset( $args['protection_type'] ) ? $args['protection_type'] : 'override_contents';
?>
<div class="protection-type mb-3">

	<label class="form-label" for="protection_type"><?php esc_html_e( 'Select how to protect your content', 'all-in-one-content-restriction' );?></label>
	<select id="protection_type" class="form-select form-control">
		<option value="override_contents" <?php selected( 'override_contents' == $protection_type );?>><?php esc_html_e( 'Override content', 'all-in-one-content-restriction' );?></option>
		<option value="login_and_back" <?php selected( 'login_and_back' == $protection_type );?>><?php esc_html_e( 'Login & back to current page/post', 'all-in-one-content-restriction' );?></option>
		<option value="redirect" <?php selected( 'redirect' == $protection_type );?>><?php esc_html_e( 'Redirect', 'all-in-one-content-restriction' );?></option>
		<option value="blur" <?php selected( 'blur' == $protection_type );?>><?php esc_html_e( 'Blur', 'all-in-one-content-restriction' );?></option>
		<option value="obfuscate" <?php selected( 'obfuscate' == $protection_type );?>><?php esc_html_e( 'Obfuscate', 'all-in-one-content-restriction' );?></option>
		<option value="hide_from_loop" <?php selected( 'hide_from_loop' == $protection_type );?>><?php esc_html_e( 'Hide', 'all-in-one-content-restriction' );?></option>
	</select>

</div>