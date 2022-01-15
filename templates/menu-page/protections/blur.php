<?php
/**
 * @author  HeyMehedi
 * @since   1.4
 * @version 1.4
 */

use HeyMehedi\All_In_One_Content_Restriction\Helper;
use HeyMehedi\All_In_One_Content_Restriction\Markup_Manager;

$blur_level          = isset( $args['blur_level'] ) ? $args['blur_level'] : 15;
$spread              = isset( $args['spread'] ) ? $args['spread'] : 20;
$selected_blur_items = isset( $args['blur_apply_to'] ) ? $args['blur_apply_to'] : array();
?>
<div class="part4 mb-3" id="blur">

	<label for="heymehedi_blur_the_title" class="form-label">
		<?php esc_html_e( 'Blur Level', 'all-in-one-content-restriction' );?> <span class="helper-text" data-container="body" data-toggle="popover" data-placement="right" title="<?php esc_attr_e( 'Replace Title', 'all-in-one-content-restriction' );?>" data-content="<?php echo wp_kses_post( '___ %%title%% ___  . Example : <strong>Protected</strong> : %%title%% = <strong>Protected</strong> : How to run a successful members only blog.' ); ?>"><img src="<?php echo Helper::get_file_uri( 'admin/images/question-mark.png' ) ?>" alt=""></span>
	</label>
	<div class="slider-group">
		<div class="slider-range blur_level" data-amount="<?php echo esc_attr( $blur_level ) ?>"></div>
		<input id="blur_level" type="hidden" value="">
	</div>

	<label for="heymehedi_blur_the_excerpt" class="form-label">
		<?php esc_html_e( 'Spread', 'all-in-one-content-restriction' );?> <span class="helper-text" data-container="body" data-toggle="popover" data-placement="right" title="<?php esc_attr_e( 'Replace Excerpt', 'all-in-one-content-restriction' );?>" data-content="<?php echo wp_kses_post( "___ %%excerpt%% ___ . Example :  %%excerpt%% : <strong>continue reading full article with a XYZ  membership </strong>= Do you want to restrict content on your WordPress website so that only certain users can access it? : <strong>continue reading full article with a XYZ  membership</strong>." ); ?>"><img src="<?php echo Helper::get_file_uri( 'admin/images/question-mark.png' ) ?>" alt=""></span>
	</label>
	<div class="slider-group">
		<div class="slider-range spread" data-amount="<?php echo esc_attr( $spread ) ?>"></div>
		<input id="spread" type="hidden" value="">
	</div>

	<label for="heymehedi_custom_editor" class="form-label">
		<?php esc_html_e( 'Apply to', 'all-in-one-content-restriction' );?> <span class="helper-text" data-container="body" data-toggle="popover" data-placement="right" title="<?php esc_attr_e( 'Replace Description', 'all-in-one-content-restriction' );?>" data-content="<?php echo wp_kses_post( "refers to a custom parapraph or sentence related to the specific restricted page/ post. <strong> Tip </strong> : A few sentences as a preview of the post/page is a good practice for gaining  users' traction to sign up for the membership." ); ?>"><img src="<?php echo Helper::get_file_uri( 'admin/images/question-mark.png' ) ?>" alt=""></span>
	</label>
	<select id="blur_apply_to" class="form-control" multiple>
		<?php echo Markup_Manager::blur_apply_to_html( $selected_blur_items ); ?>
	</select>
</div>