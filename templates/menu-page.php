<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

use HeyMehedi\All_In_One_Content_Restriction\Helper;

$active_index = isset( $args['active_index'] ) ? $args['active_index'] : '';
?>
<div class="container-fluid mt-5" id="heymehedi-main">

	<div class="row">

		<div class="col-md-6 offset-md-3" style="margin: 0 auto;">

			<form id="heymehedi-form" method="post">

				<div class="heymehedi_setting_heading">
					<h1><?php esc_html_e( 'All in One Content Restriction', 'all-in-one-content-restriction' );?></h1>
				</div>

				<div class="part4 mb-3">

					<label for="title" class="form-label">
						<?php esc_html_e( 'Restriction Title', 'all-in-one-content-restriction' );?>
					</label>
					<input id="title" type="text" value="<?php echo wp_kses_post( isset( $args['title'] ) ? $args['title'] : '' ); ?>" placeholder="<?php esc_attr_e( 'Hello World', 'all-in-one-content-restriction' );?>" class="form-control">

				</div>

				<?php Helper::get_template_part( 'menu-page/post-types', $args );?>

				<?php //Helper::get_template_part( 'menu-page/protection-type', $args );?>

				<?php Helper::get_template_part( 'menu-page/roles', $args );?>

				<?php // Helper::get_template_part( 'menu-page/override-contents', $args );?>

				<?php // Helper::get_template_part( 'menu-page/redirect', $args );?>

				<input type="hidden" value="<?php echo esc_attr( $_GET['action'] ); ?>" id="heymehedi-action" data-restriction-id="<?php echo esc_attr( Helper::get_restriction_id() ); ?>">

				<p class="submit">
					<input type="submit" name="submit" id="heymehedi-submit" class="button button-primary" value="<?php esc_attr_e( 'Save Changes', 'all-in-one-content-restriction' );?>">
				</p>

				<p id="heymehedi-msg"></p>

			</form>

		</div>

		<!-- <div class="col-md-6">

			<?php // Helper::get_template_part( 'menu-page/selected-items', $args );?>

		</div> -->

	</div>

</div>