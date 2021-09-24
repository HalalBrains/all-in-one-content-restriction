<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.1
 */

$redirection_type = isset( $args['redirection_type'] ) ? $args['redirection_type'] : 'homepage';
$custom_url       = isset( $args['custom_url'] ) ? $args['custom_url'] : '';
?>
<div class="part4 mb-3" id="redirect">

	<label class="form-label" for="redirection_type"><?php esc_html_e( 'Where will they be taken? ', 'all-in-one-content-restriction' );?></label>
	<select id="redirection_type" class="form-select form-control">
		<option value="homepage" <?php selected( 'homepage' == $redirection_type );?>><?php esc_html_e( 'Home Page', 'all-in-one-content-restriction' );?></option>
		<option value="custom_url" <?php selected( 'custom_url' == $redirection_type );?>><?php esc_html_e( 'Custom URL', 'all-in-one-content-restriction' );?></option>
	</select>

	<div class="custom_url_box">
		<label class="form-label" for="custom_url"><?php esc_html_e( 'Redirect URL', 'all-in-one-content-restriction' );?></label>
		<input type="url" placeholder="<?php esc_html_e( 'https://your-url.com', 'all-in-one-content-restriction' );?>" class="form-control" id="custom_url" value="<?php echo wp_kses_post( $custom_url ); ?>">
	</div>

</div>