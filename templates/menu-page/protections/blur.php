<?php
/**
 * @author  HeyMehedi
 * @since   1.4
 * @version 1.4
 */

use HeyMehedi\All_In_One_Content_Restriction\Helper;
?>
<div class="part4 mb-3" id="blur">

	<label for="heymehedi_blur_the_title" class="form-label">
		<?php esc_html_e( 'Replace Title', 'all-in-one-content-restriction' );?> <span class="helper-text" data-container="body" data-toggle="popover" data-placement="right" title="<?php esc_attr_e( 'Replace Title', 'all-in-one-content-restriction' );?>" data-content="<?php echo wp_kses_post( '___ %%title%% ___  . Example : <strong>Protected</strong> : %%title%% = <strong>Protected</strong> : How to run a successful members only blog.' ) ; ?>"><img src="<?php echo Helper::get_file_uri( 'admin/images/question-mark.png' ) ?>" alt=""></span>
	</label>
	<input id="heymehedi_blur_the_title" type="text" value="<?php echo wp_kses_post( isset( $args['blur_the_title'] ) ? $args['blur_the_title'] : '' ); ?>" placeholder="<?php esc_attr_e( 'Enter a custom title to display to restricted users', 'all-in-one-content-restriction' );?>" class="form-control">

	<label for="heymehedi_blur_the_excerpt" class="form-label">
		<?php esc_html_e( 'Replace Excerpt', 'all-in-one-content-restriction' );?> <span class="helper-text" data-container="body" data-toggle="popover" data-placement="right" title="<?php esc_attr_e( 'Replace Excerpt', 'all-in-one-content-restriction' );?>" data-content="<?php echo wp_kses_post( "___ %%excerpt%% ___ . Example :  %%excerpt%% : <strong>continue reading full article with a XYZ  membership </strong>= Do you want to restrict content on your WordPress website so that only certain users can access it? : <strong>continue reading full article with a XYZ  membership</strong>." ) ; ?>"><img src="<?php echo Helper::get_file_uri( 'admin/images/question-mark.png' ) ?>" alt=""></span>
	</label>
	<textarea class="form-control" name="heymehedi_blur_the_excerpt" id="heymehedi_the_excerpt" rows="4" placeholder="<?php esc_attr_e( 'Enter a custom excerpt  to display to restricted users', 'all-in-one-content-restriction' );?>"><?php echo wp_kses_post( isset( $args['blur_the_excerpt'] ) ? stripslashes( wp_specialchars_decode( $args['blur_the_excerpt'], ENT_QUOTES, 'UTF-8' ) ) : '' ); ?></textarea>

	<label for="heymehedi_custom_editor" class="form-label">
		<?php esc_html_e( 'Replace Description', 'all-in-one-content-restriction' );?> <span class="helper-text" data-container="body" data-toggle="popover" data-placement="right" title="<?php esc_attr_e( 'Replace Description', 'all-in-one-content-restriction' );?>" data-content="<?php echo wp_kses_post( "refers to a custom parapraph or sentence related to the specific restricted page/ post. <strong> Tip </strong> : A few sentences as a preview of the post/page is a good practice for gaining  users' traction to sign up for the membership." ) ; ?>"><img src="<?php echo Helper::get_file_uri( 'admin/images/question-mark.png' ) ?>" alt=""></span>
	</label>
	<?php Helper::get_text_editor( isset( $args['blur_the_content'] ) ? stripslashes( wp_specialchars_decode( $args['blur_the_content'], ENT_QUOTES, 'UTF-8' ) ) : '' );?>

</div>