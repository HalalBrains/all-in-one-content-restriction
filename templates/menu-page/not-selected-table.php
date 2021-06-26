<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */
?>

<label for="post-type" class="form-label"><?php esc_attr_e( 'Post Type', 'content-restriction' );?></label>
<select class="form-select form-control" id="post-type" name="post-type">
	<option value="post" selected><?php esc_attr_e( 'Post', 'content-restriction' );?></option>
	<option value="page"><?php esc_attr_e( 'Page', 'content-restriction' );?></option>
</select>

<label for="restriction-wise" class="form-label"><?php esc_attr_e( 'Restriction Wise', 'content-restriction' );?></label>
<select class="form-select form-control" id="restriction-wise" name="restriction-wise">
	<option value="category"><?php esc_attr_e( 'Category', 'content-restriction' );?></option>
	<option value="single-post"><?php esc_attr_e( 'Single Post', 'content-restriction' );?></option>
</select>


<label for="heymehedi-search_bar" class="form-label"><?php esc_attr_e( 'Type the title or ID', 'content-restriction' );?></label>
<input id="heymehedi-search_bar" type="text" class="form-control" placeholder="<?php esc_html_e( 'Search Here...', 'content-restriction' )?>">


<div id="heymehedi-items-wrapper">

	<table id="heymehedi-items_table">

		<thead>
			<tr>
				<th class="text-center"><?php esc_html_e( 'Add', 'content-restriction' );?></th>
				<th class="text-center"><?php esc_html_e( 'ID', 'content-restriction' );?></th>
				<th><?php esc_html_e( 'Title', 'content-restriction' );?></th>
			</tr>
		</thead>

		<tbody id="heymehedi-items_table_body"></tbody>

	</table>

</div>

<label for="exampleFormControlInput1" class="form-label">Email address</label>
<input class="form-control" type="text" id="hide-content"  name="hide-content" value="<?php echo get_option( 'hide-content' ); ?>">
