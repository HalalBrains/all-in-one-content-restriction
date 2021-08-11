<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

use HeyMehedi\AIO_Content_Restriction\Helper;
?>
<div class="part4 mb-3" id="override_contents">

	<label for="heymehedi_the_title" class="form-label">
		<?php esc_html_e( 'Replace Default Title', 'aio-content-restriction' );?>
		<span class="heymehedi_helper_text" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php esc_attr_e( 'Use the_title by %%title%%', 'aio-content-restriction' );?>"><?php esc_html_e( '?', 'aio-content-restriction' );?></span>
	</label>
	<input id="heymehedi_the_title" type="text" value="<?php echo wp_kses_post( $args['the_title'] ); ?>" placeholder="<?php esc_attr_e( 'Prefix %%title%% Suffix', 'aio-content-restriction' );?>" class="form-control">

	<label for="heymehedi_the_excerpt" class="form-label">
		<?php esc_html_e( 'Replace Default Excerpt', 'aio-content-restriction' );?>
		<span class="heymehedi_helper_text" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php esc_attr_e( 'Use the_content by %%excerpt%%', 'aio-content-restriction' );?>"><?php esc_html_e( '?', 'aio-content-restriction' );?></span>
	</label>
	<textarea class="form-control" name="heymehedi_the_excerpt" id="heymehedi_the_excerpt" rows="5"><?php echo wp_kses_post( $args['the_excerpt'] ); ?></textarea>

	<label for="heymehedi_custom_editor" class="form-label">
		<?php esc_html_e( 'Replace Default Description', 'aio-content-restriction' );?>
		<span class="heymehedi_helper_text" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php esc_attr_e( 'Use the_content by %%content%%', 'aio-content-restriction' );?>"><?php esc_html_e( '?', 'aio-content-restriction' );?></span>
	</label>
	<?php Helper::get_text_editor( $args['the_content'] );?>

</div>