<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

use HeyMehedi\All_In_One_Content_Restriction\Markup_Manager;

$post_type      = isset( $args['post_type'] ) ? $args['post_type'] : 'post';
$restriction_in = isset( $args['restriction_in'] ) ? $args['restriction_in'] : 'category';
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

			<?php echo Markup_Manager::display_taxonomy_single_items_html( $post_type, $restriction_in, 'dashicons-plus-alt2' ); ?>

		</tbody>

	</table>

</div>