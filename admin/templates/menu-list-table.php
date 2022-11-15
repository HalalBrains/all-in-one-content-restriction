<?php
/**
 * @author  HeyMehedi
 * @since   1.1
 * @version 1.0
 */

use HeyMehedi\All_In_One_Content_Restriction\Helper;
?>
<?php Helper::get_template_part_admin( 'header-banner' );?>

<div class="container-fluid mt-5 p-3" id="heymehedi-main">
	<div class="row">
		<div class="col-md-12" style="margin: 0 auto;">
			<div class="wrap">

				<h2><?php esc_html_e( 'Overview', 'all-in-one-content-restriction' );?> 
					<a href="<?php echo admin_url( 'admin.php?page=restrictions&action=new' ); ?>" class="add-new-h2"><?php _e( 'Add New', 'all-in-one-content-restriction' );?></a>
				</h2>

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