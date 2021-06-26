<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

use HeyMehedi\Content_Restriction\Helper;
$active_wise_index = $args['active_wise_index'];
?>
<div class="container-fluid">

	<div class="row">

		<div class="col-md-12">

			<div class="heymehedi_setting_heading">

				<h2><?php esc_html_e( 'Content Restriction', 'content-restriction' );?></h2>

			</div>

			<form id="heymehedi-form" method="post">

				<div class="row">

					<div class="col-md-6">

						<label for="post-type" class="form-label"><?php esc_attr_e( 'Post Type', 'content-restriction' );?></label>
						<select class="form-select form-control" id="post-type" name="post-type">
							<option value="post" <?php selected( 'post' == $args['post_type'] );?> ><?php esc_attr_e( 'Post', 'content-restriction' );?></option>
						</select>

						<label for="restriction-wise" class="form-label"><?php esc_attr_e( 'Restriction Wise', 'content-restriction' );?></label>
						<select class="form-select form-control" id="restriction-wise" name="restriction-wise">
							<option value="category" <?php selected( 'category' == $args['restriction_wise'] );?>><?php esc_attr_e( 'Category', 'content-restriction' );?></option>
							<option value="single_post" <?php selected( 'single_post' == $args['restriction_wise'] );?>><?php esc_attr_e( 'Single Post', 'content-restriction' );?></option>
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

								<tbody id="heymehedi-items_table_body">

									<?php echo Helper::display_items( $args['restriction_wise'], 'dashicons-plus-alt2',$args[$active_wise_index] ); ?>

								</tbody>

							</table>

						</div>

						<label for="exampleFormControlInput1" class="form-label">Email address</label>
						<input class="form-control" type="text" id="hide-content"  name="hide-content" value="<?php echo get_option( 'hide-content' ); ?>">

					</div>

					<div class="col-md-6">

						<h2>Selected Items</h2>

						<div id="heymehedi-selected_items-wrapper">

							<table id="heymehedi-selected_items_table">

								<thead>

									<tr>
										<th class="text-center"><?php esc_html_e( 'Add', 'content-restriction' );?></th>
										<th class="text-center"><?php esc_html_e( 'ID', 'content-restriction' );?></th>
										<th><?php esc_html_e( 'Title', 'content-restriction' );?></th>
									</tr>

								</thead>

								<tbody id="heymehedi-selected_items_table_body">

									<?php echo Helper::display_items( $args['restriction_wise'], 'dashicons-minus', array(), $args[$active_wise_index], true ); ?>

								</tbody>

							</table>

						</div>

					</div>

					<p class="submit">
						<input type="submit" name="submit" id="heymehedi-submit" class="button button-primary" value="<?php esc_attr_e( 'Save Changes', 'content-restriction' )?>">
					</p>

				</div>

			</form>

		</div>

	</div>

</div>

