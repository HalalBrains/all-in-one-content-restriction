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
<div class="part1 mb-3">

	<label for="post-type" class="form-label"><?php esc_html_e( 'Post Type', 'all-in-one-content-restriction' );?></label>
	<select class="form-select form-control" id="post-type" name="post-type">
		<?php echo Markup_Manager::get_post_types_options( $post_type ); ?>
	</select>

	<label for="restriction-in" class="form-label"><?php esc_html_e( 'Restrict in', 'all-in-one-content-restriction' );?></label>
	<select class="form-select form-control" id="restriction-in" name="restriction-in">
		<?php echo Markup_Manager::get_restriction_in_options( $post_type, $restriction_in ); ?>
	</select>

	<label for="heymehedi-search_bar" class="form-label"><?php esc_html_e( 'Type the title or ID', 'all-in-one-content-restriction' );?></label>
	<input id="heymehedi-search_bar" type="text" class="form-control" placeholder="<?php esc_attr_e( 'Search Here...', 'all-in-one-content-restriction' );?>">

	<?php // Helper::get_template_part( 'menu-page/items-table', $args );?>

</div>
