<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

use HeyMehedi\All_In_One_Content_Restriction\Helper;
?>
<div class="part1 mb-3">

	<div class="heymehedi_setting_heading">
		<h1><?php esc_html_e( 'All in One Content Restriction', 'all-in-one-content-restriction' );?></h1>
	</div>

	<label for="post-type" class="form-label"><?php esc_html_e( 'Post Type', 'all-in-one-content-restriction' );?></label>
	<select class="form-select form-control" id="post-type" name="post-type">
		<option value="posts" <?php selected( 'posts' == $args['post_type'] );?>><?php esc_html_e( 'Posts', 'all-in-one-content-restriction' );?></option>
	</select>

	<label for="restriction-in" class="form-label"><?php esc_html_e( 'Restrict in', 'all-in-one-content-restriction' );?></label>
	<select class="form-select form-control" id="restriction-in" name="restriction-in">
		<option value="category" <?php selected( 'category' == $args['restrict_in'] );?>><?php esc_html_e( 'Category', 'all-in-one-content-restriction' );?></option>
		<option value="single_post" <?php selected( 'single_post' == $args['restrict_in'] );?>><?php esc_html_e( 'Single Post', 'all-in-one-content-restriction' );?></option>
	</select>

	<label for="heymehedi-search_bar" class="form-label"><?php esc_html_e( 'Type the title or ID', 'all-in-one-content-restriction' );?></label>
	<input id="heymehedi-search_bar" type="text" class="form-control" placeholder="<?php esc_attr_e( 'Search Here...', 'all-in-one-content-restriction' );?>">

	<?php Helper::get_template_part( 'menu-page/items-table', $args); ?>

</div>
