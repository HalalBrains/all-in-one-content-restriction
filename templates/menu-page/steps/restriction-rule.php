<?php
/**
 * @author  HeyMehedi
 * @since   1.3
 * @version 1.4
 */

use HeyMehedi\All_In_One_Content_Restriction\Helper;
?>
<fieldset>

	<div class="form-card">
		
		<h2 class="fs-title"><?php esc_attr_e( 'Restriction rule', 'all-in-one-content-restriction' );?></h2>
			
		<div class="rule-title mb-3">
			<label for="title" class="form-label">
				<?php esc_html_e( 'Name', 'all-in-one-content-restriction' );?> <span class="helper-text" data-container="body" data-toggle="popover" data-placement="right" title="<?php esc_attr_e( 'Restriction name', 'all-in-one-content-restriction' );?>" data-content="<?php esc_attr_e( 'refers to understanding the reason for the restriction rule' );?>"><img src="<?php echo Helper::get_file_uri( 'admin/images/question-mark.png' ) ?>" alt=""></span>
			</label>
			<input id="title" type="text" value="<?php echo wp_kses_post( isset( $args['title'] ) ? $args['title'] : '' ); ?>" placeholder="<?php esc_attr_e( 'Posts restricted to logged out users', 'all-in-one-content-restriction' );?>" class="form-control">
		</div>

		<?php Helper::get_template_part( 'menu-page/post-types', $args );?>

		<?php Helper::get_template_part( 'menu-page/protection-type', $args );?>

		<?php Helper::get_template_part( 'menu-page/roles', $args );?>

		<div class="access-priority">
			<label for="priority" class="form-label">
				<?php esc_html_e( 'Access Priority', 'all-in-one-content-restriction' );?> <span class="helper-text" data-container="body" data-toggle="popover" data-placement="right" title="<?php esc_attr_e( 'Access Priority', 'all-in-one-content-restriction' );?>" data-content="<?php esc_attr_e( "refers to a tiered system where a user's ability to view content is determined by the access priority assigned to their role. The post/ page with an access priority of 10 can view content assigned to access levels of 10 and lower, whereas a user with an access level of 9 can only view content assigned to levels of 9 and lower. Leave empty for default or if you don't need to set multiple access priority." );?>"><img src="<?php echo Helper::get_file_uri( 'admin/images/question-mark.png' ) ?>" alt=""></span>
			</label>
			<input id="priority" type="number" value="<?php echo wp_kses_post( isset( $args['priority'] ) ? $args['priority'] : '10' ); ?>" placeholder="<?php esc_attr_e( 'Level of access this restriction gives.', 'all-in-one-content-restriction' );?>" class="form-control" required>
		</div>
			
	</div>

	<a href="<?php echo admin_url('admin.php?page=all-in-one-content-restriction') ; ?>" class="previous action-button-previous"><?php esc_html_e( 'Back', 'all-in-one-content-restriction' ); ?></a>
	<input type="submit" name="submit" class="hide-save-first action-button heymehedi-submit" value="<?php esc_attr_e( 'Save', 'all-in-one-content-restriction' );?>">
	<input type="button" name="next" class="hide-next-first common-next-submit-btn next action-button" value="<?php esc_attr_e( 'Next', 'all-in-one-content-restriction' ); ?>" />

</fieldset>