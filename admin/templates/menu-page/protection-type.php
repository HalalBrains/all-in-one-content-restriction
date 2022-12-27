<?php
/**
 * @author  HeyMehedi
 * @since   1.0.0
 * @version 1.6.6
 */

use HeyMehedi\All_In_One_Content_Restriction\Settings;

$protection_type = isset( $args['protection_type'] ) ? $args['protection_type'] : 'override_contents';
?>
<div class="protection-type mb-3">

	<label class="form-label" for="protection_type"><?php esc_html_e( 'Select how to protect your content', 'all-in-one-content-restriction' );?></label>
	<select id="protection_type" class="form-select form-control">
		<?php 
			foreach ( Settings::get_protections_list() as $key => $value) {
				printf( '<option value="%s" %s>%s</option>', $key, selected( $key == $protection_type ), $value );
			}
		?>
	</select>

</div>