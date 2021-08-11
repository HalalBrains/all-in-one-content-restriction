<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

use HeyMehedi\AIO_Content_Restriction\Helper;
?>
<div class="part5">

	<h2><?php esc_html_e( 'Selected items', 'aio-content-restriction' );?></h2>

	<label for="heymehedi-search_bar_selected" class="form-label"><?php esc_html_e( 'Type the title or ID', 'aio-content-restriction' );?></label>
	<input id="heymehedi-search_bar_selected" type="text" class="form-control" placeholder="<?php esc_attr_e( 'Search Here...', 'aio-content-restriction' );?>">

	<div id="heymehedi-items-wrapper-selected">

		<table id="heymehedi-selected_items_table">

			<thead>

				<tr>
					<th class="text-center"><?php esc_html_e( 'Drop', 'aio-content-restriction' );?></th>
					<th class="text-center"><?php esc_html_e( 'ID', 'aio-content-restriction' );?></th>
					<th><?php esc_html_e( 'Title', 'aio-content-restriction' );?></th>
				</tr>

			</thead>

			<tbody id="heymehedi-selected_items_table_body">

				<?php echo Helper::display_items( $args['restrict_in'], 'dashicons-minus', array(), $args[$active_index], true ); ?>

			</tbody>

		</table>

	</div>

</div>