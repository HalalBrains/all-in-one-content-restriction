<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.1
 */

use HeyMehedi\All_In_One_Content_Restriction\Helper;
?>
<div class="part4 mb-3" id="override_contents">

	<label for="heymehedi_the_title" class="form-label">
		<?php esc_html_e( 'Replace Default Title', 'all-in-one-content-restriction' );?>
		<span class="heymehedi_helper_text" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php esc_attr_e( 'Use actual title by %%title%%', 'all-in-one-content-restriction' );?>"><?php esc_html_e( '?', 'all-in-one-content-restriction' );?></span>
	</label>
	<input id="heymehedi_the_title" type="text" value="<?php echo wp_kses_post( isset( $args['the_title'] ) ? $args['the_title'] : '' ); ?>" placeholder="<?php esc_attr_e( 'Prefix %%title%% Suffix', 'all-in-one-content-restriction' );?>" class="form-control">

	<label for="heymehedi_the_excerpt" class="form-label">
		<?php esc_html_e( 'Replace Default Excerpt', 'all-in-one-content-restriction' );?>
		<span class="heymehedi_helper_text" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php esc_attr_e( 'Use actual excerpt by %%excerpt%%', 'all-in-one-content-restriction' );?>"><?php esc_html_e( '?', 'all-in-one-content-restriction' );?></span>
	</label>
	<textarea class="form-control" name="heymehedi_the_excerpt" id="heymehedi_the_excerpt" rows="5" placeholder="<?php esc_attr_e( 'Prefix %%excerpt%% Suffix', 'all-in-one-content-restriction' );?>"><?php echo wp_kses_post( isset( $args['the_excerpt'] ) ? stripslashes( wp_specialchars_decode( $args['the_excerpt'], ENT_QUOTES, 'UTF-8' ) ) : '' ); ?></textarea>

	<label for="heymehedi_custom_editor" class="form-label">
		<?php esc_html_e( 'Replace Default Description', 'all-in-one-content-restriction' );?>
		<span class="heymehedi_helper_text" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php esc_attr_e( 'Use actual description/content by %%content%%', 'all-in-one-content-restriction' );?>"><?php esc_html_e( '?', 'all-in-one-content-restriction' );?></span>
	</label>
	<?php Helper::get_text_editor( isset( $args['the_content'] ) ? stripslashes( wp_specialchars_decode( $args['the_content'], ENT_QUOTES, 'UTF-8' ) ) : '' );?>

</div>