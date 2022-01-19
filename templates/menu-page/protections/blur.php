<?php
/**
 * @author  HeyMehedi
 * @since   1.4
 * @version 1.5
 */

use HeyMehedi\All_In_One_Content_Restriction\Markup_Manager;

$blur_level          = isset( $args['blur_level'] ) ? $args['blur_level'] : 7;
$spread              = isset( $args['spread'] ) ? $args['spread'] : 7;
$selected_blur_items = isset( $args['blur_apply_to'] ) ? $args['blur_apply_to'] : array();
?>
<div class="part4 mb-3" id="blur">

	<label for="heymehedi_blur_the_title" class="form-label">
		<?php esc_html_e( 'Blur Level', 'all-in-one-content-restriction' );?>
	</label>
	<div class="slider-group">
		<div class="slider-range blur_level" data-amount="<?php echo esc_attr( $blur_level ) ?>"></div>
		<input id="blur_level" type="hidden" value="">
	</div>

	<label for="heymehedi_blur_the_excerpt" class="form-label">
		<?php esc_html_e( 'Spread', 'all-in-one-content-restriction' );?>
	</label>
	<div class="slider-group">
		<div class="slider-range spread" data-amount="<?php echo esc_attr( $spread ) ?>"></div>
		<input id="spread" type="hidden" value="">
	</div>

	<label for="blur_apply_to" class="form-label">
		<?php esc_html_e( 'Apply to', 'all-in-one-content-restriction' );?>
	</label>
	<select id="blur_apply_to" class="form-control" multiple>
		<?php echo Markup_Manager::apply_to_html( $selected_blur_items ); ?>
	</select>
</div>