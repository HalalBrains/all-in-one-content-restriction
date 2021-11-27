<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.1.1
 */

use HeyMehedi\All_In_One_Content_Restriction\Helper;
use HeyMehedi\All_In_One_Content_Restriction\Post_Type_Taxonomies;

$post_type      = isset( $args['post_type'] ) ? $args['post_type'] : 'post';
$restrict_in = isset( $args['restrict_in'] ) ? $args['restrict_in'] : 'category';
?>
<div class="post-types mb-3">

	<label for="post-type" class="form-label"><?php esc_html_e( 'Type', 'all-in-one-content-restriction' );?> <span class="helper-text" data-container="body" data-toggle="popover" data-placement="right" title="<?php esc_attr_e( 'Content-Type', 'all-in-one-content-restriction' );?>" data-content="<?php esc_attr_e( 'Specify types of content  that are restricted to certain user roles.' ) ; ?>"><img src="<?php echo Helper::get_file_uri( 'admin/images/question-mark.png' ) ?>" alt=""></span></label> 
	<select class="form-select form-control" id="post-type" name="post-type">
		<?php echo Post_Type_Taxonomies::get_post_types_options( $post_type ); ?>
	</select>

	<label for="restriction-in" class="form-label"><?php esc_html_e( 'Restrict in', 'all-in-one-content-restriction' );?></label>
	<select class="form-select form-control" id="restriction-in" name="restriction-in">
		<?php echo Post_Type_Taxonomies::get_restrict_in_options( $post_type, $restrict_in ); ?>
	</select>

</div>