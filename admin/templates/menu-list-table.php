<?php
/**
 * @author  HeyMehedi
 * @since   1.1
 * @version 1.0
 */

use HeyMehedi\All_In_One_Content_Restriction\Helper;
?>
<?php Helper::get_template_part_admin( 'header-banner' );?>

<style>
	.header-action {
    display: flex;
    justify-content: space-between;
    align-items: self-start;
}
</style>
<div class="container mt-5">
	<div class="row">
		<div class="col-md-12 border-bottom">
			<h4 class="fs-4 text-dark"><?php esc_html_e( 'Restriction Options', 'all-in-one-content-restriction') ?></h4>
		</div>
	</div>
</div>

<div class="container mt-5">
	<div class="row">
		<div class="col-md-12">
			<div class="wrap">

				<div class="header-action">
					<h5 class="fs-5"><?php esc_html_e( 'Overview', 'all-in-one-content-restriction' );?></h5>
					<a href="<?php echo admin_url( 'admin.php?page=restrictions&action=new' ); ?>" class="button button-primary add-new-h2"><?php _e( 'Add New', 'all-in-one-content-restriction' );?></a>
				</div>

				<form method="post">

					<input type="hidden" name="page" value="all_in_one_content_restriction_list_table">

					<?php
					$args->prepare_items();
					// $list_table->search_box( 'search', 'search_id' );
					$args->display(); 
					?>

				</form>

			</div>
		</div>
	</div>
</div>

<?php Helper::get_template_part_admin( 'footer-message' );