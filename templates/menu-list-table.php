<?php
/**
 * @author  HeyMehedi
 * @since   1.1
 * @version 1.0
 */
?>
<div class="wrap">

	<h2><?php esc_html_e( 'All in One Content Restriction', 'all-in-one-content-restriction' );?> <a href="<?php echo admin_url( 'admin.php?page=all-in-one-content-restriction&action=new' ); ?>" class="add-new-h2"><?php _e( 'Add New', 'all-in-one-content-restriction' );?></a></h2>

	<form method="post">

		<input type="hidden" name="page" value="all_in_one_content_restriction_list_table">

		<?php
		$args->prepare_items();
		// $list_table->search_box( 'search', 'search_id' );
		$args->display(); 
		?>

	</form>

</div>