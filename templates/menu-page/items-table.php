<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

use HeyMehedi\AIO_Content_Restriction\Helper;
?>
<div id="heymehedi-items-wrapper">

	<table id="heymehedi-items_table">

		<thead>
			<tr>
				<th class="text-center"><?php esc_html_e( 'Add', 'aio-content-restriction' );?></th>
				<th class="text-center"><?php esc_html_e( 'ID', 'aio-content-restriction' );?></th>
				<th><?php esc_html_e( 'Title', 'aio-content-restriction' );?></th>
			</tr>
		</thead>

		<tbody id="heymehedi-items_table_body">

			<?php echo Helper::display_items( $args['restrict_in'], 'dashicons-plus-alt2', $args[$active_index] ); ?>

		</tbody>

	</table>

</div>