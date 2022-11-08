<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.1
 */

use HeyMehedi\All_In_One_Content_Restriction\Markup_Manager;

$post_type   = isset( $args['post_type'] ) ? $args['post_type'] : 'post';
$restrict_in = isset( $args['restrict_in'] ) ? $args['restrict_in'] : 'category';
?>
<div id="heymehedi-items-wrapper">

	<table id="heymehedi-items_table">

		<thead>
			<tr>
				<th class="text-center"><?php esc_html_e( 'Add', 'all-in-one-content-restriction' );?></th>
				<th class="text-center"><?php esc_html_e( 'ID', 'all-in-one-content-restriction' );?></th>
				<th><?php esc_html_e( 'Title', 'all-in-one-content-restriction' );?></th>
			</tr>
		</thead>

		<tbody id="heymehedi-items_table_body">

			<?php echo Markup_Manager::display_taxonomy_single_items_html( 
				$post_type,
				$restrict_in,
				'dashicons-plus-alt2', 
				isset( $args['selected_ids'] ) ? $args['selected_ids'] : array() ); ?>

		</tbody>

	</table>

</div>