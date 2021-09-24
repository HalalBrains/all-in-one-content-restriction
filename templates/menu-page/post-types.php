<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.1
 */

use HeyMehedi\All_In_One_Content_Restriction\Helper;
use HeyMehedi\All_In_One_Content_Restriction\Post_Type_Taxonomies;

$post_type      = isset( $args['post_type'] ) ? $args['post_type'] : 'post';
$restrict_in = isset( $args['restrict_in'] ) ? $args['restrict_in'] : 'category';
?>
<div class="part1 mb-3">

	<label for="post-type" class="form-label"><?php esc_html_e( 'Content-Type', 'all-in-one-content-restriction' );?></label>
	<select class="form-select form-control" id="post-type" name="post-type">
		<?php echo Post_Type_Taxonomies::get_post_types_options( $post_type ); ?>
	</select>

	<label for="restriction-in" class="form-label"><?php esc_html_e( 'Restrict in', 'all-in-one-content-restriction' );?></label>
	<select class="form-select form-control" id="restriction-in" name="restriction-in">
		<?php echo Post_Type_Taxonomies::get_restrict_in_options( $post_type, $restrict_in ); ?>
	</select>

	<div id="heymehedi-items-table-wrapper">

		<label for="heymehedi-search_bar" class="form-label"><?php esc_html_e( 'Title or ID', 'all-in-one-content-restriction' );?></label>
		<input id="heymehedi-search_bar" type="text" class="form-control" placeholder="<?php esc_attr_e( 'Type to search', 'all-in-one-content-restriction' );?>">

		<?php Helper::get_template_part( 'menu-page/items-table', $args );?>

	</div>


</div>
