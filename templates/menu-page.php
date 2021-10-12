<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.1.1
 */

use HeyMehedi\All_In_One_Content_Restriction\Helper;

$active_index = isset( $args['active_index'] ) ? $args['active_index'] : '';
?>
<div class="container-fluid mt-5" id="heymehedi-main">

	<div class="row">

		<div class="col-md-6" style="margin: 0 auto;">

			<form id="heymehedi-form" method="post">
				
				<div class="heymehedi_setting_heading">
					<h1><?php esc_html_e( 'Setup Content Restriction Rule', 'all-in-one-content-restriction' );?></h1>
				</div>

				<div class="part4 mb-3">

					<label for="title" class="form-label">
						<?php esc_html_e( 'Restriction name', 'all-in-one-content-restriction' );?> <span class="helper-text" data-container="body" data-toggle="popover" data-placement="right" title="<?php esc_attr_e( 'Restriction name', 'all-in-one-content-restriction' );?>" data-content="<?php esc_attr_e( 'refers to understanding the reason for the restriction rule' ) ; ?>"><img src="<?php echo Helper::get_file_uri( 'admin/images/question-mark.png' ) ?>" alt=""></span>
					</label>
					<input id="title" type="text" value="<?php echo wp_kses_post( isset( $args['title'] ) ? $args['title'] : '' ); ?>" placeholder="<?php esc_attr_e( 'Posts restricted to logged out users', 'all-in-one-content-restriction' );?>" class="form-control">

					<label for="priority" class="form-label">
						<?php esc_html_e( 'Access Priority', 'all-in-one-content-restriction' );?> <span class="helper-text" data-container="body" data-toggle="popover" data-placement="right" title="<?php esc_attr_e( 'Access Priority', 'all-in-one-content-restriction' );?>" data-content="<?php esc_attr_e( "refers to a tiered system where a user's ability to view content is determined by the access priority assigned to their role. The post/ page with an access priority of 10 can view content assigned to access levels of 10 and lower, whereas a user with an access level of 9 can only view content assigned to levels of 9 and lower. Leave empty for default or if you don't need to set multiple access priority." ) ; ?>"><img src="<?php echo Helper::get_file_uri( 'admin/images/question-mark.png' ) ?>" alt=""></span> 
					</label>
					<input id="priority" type="number" value="<?php echo wp_kses_post( isset( $args['priority'] ) ? $args['priority'] : '10' ); ?>" placeholder="<?php esc_attr_e( 'Level of access this restriction gives.', 'all-in-one-content-restriction' );?>" class="form-control" required>

				</div>

				<?php Helper::get_template_part( 'menu-page/post-types', $args );?>

				<?php Helper::get_template_part( 'menu-page/protection-type', $args );?>

				<?php Helper::get_template_part( 'menu-page/roles', $args );?>

				<?php Helper::get_template_part( 'menu-page/override-contents', $args );?>

				<?php Helper::get_template_part( 'menu-page/redirect', $args );?>

				<input type="hidden" value="<?php echo esc_attr( $_GET['action'] ); ?>" id="heymehedi-action" data-restriction-id="<?php echo esc_attr( Helper::get_restriction_id() ); ?>">

				<p class="submit">
					<input type="submit" name="submit" id="heymehedi-submit" class="button button-primary" value="<?php esc_attr_e( 'Save Changes', 'all-in-one-content-restriction' );?>">
				</p>

				<p id="heymehedi-msg"></p>

			</form>

		</div>

		<div class="col-md-6">

			<?php Helper::get_template_part( 'menu-page/selected-items', $args );?>

		</div>

	</div>

</div>
