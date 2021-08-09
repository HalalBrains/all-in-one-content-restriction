<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

use HeyMehedi\Exlac\Helper;

$active_index = $args['active_index'];
?>
<div class="container-fluid mt-5">

	<div class="row">

		<div class="col-md-12">

			<form id="heymehedi-form" method="post">

				<div class="row">

					<div class="col-md-6">

						<div class="part1 mb-3">

							<div class="heymehedi_setting_heading">
								<h2><?php esc_html_e( 'Exlac', 'exlac' );?></h2>
							</div>

							<label for="post-type" class="form-label"><?php esc_html_e( 'Post Type', 'exlac' );?></label>
							<select class="form-select form-control" id="post-type" name="post-type">
								<option value="posts" <?php selected( 'posts' == $args['post_type'] );?>><?php esc_html_e( 'Posts', 'exlac' );?></option>
							</select>

							<label for="restriction-in" class="form-label"><?php esc_html_e( 'Restrict in', 'exlac' );?></label>
							<select class="form-select form-control" id="restriction-in" name="restriction-in">
								<option value="category" <?php selected( 'category' == $args['restrict_in'] );?>><?php esc_html_e( 'Category', 'exlac' );?></option>
								<option value="single_post" <?php selected( 'single_post' == $args['restrict_in'] );?>><?php esc_html_e( 'Single Post', 'exlac' );?></option>
							</select>

							<label for="heymehedi-search_bar" class="form-label"><?php esc_html_e( 'Type the title or ID', 'exlac' );?></label>
							<input id="heymehedi-search_bar" type="text" class="form-control" placeholder="<?php esc_attr_e( 'Search Here...', 'exlac' );?>">

							<div id="heymehedi-items-wrapper">

								<table id="heymehedi-items_table">

									<thead>
										<tr>
											<th class="text-center"><?php esc_html_e( 'Add', 'exlac' );?></th>
											<th class="text-center"><?php esc_html_e( 'ID', 'exlac' );?></th>
											<th><?php esc_html_e( 'Title', 'exlac' );?></th>
										</tr>
									</thead>

									<tbody id="heymehedi-items_table_body">

										<?php echo Helper::display_items( $args['restrict_in'], 'dashicons-plus-alt2', $args[$active_index] ); ?>

									</tbody>

								</table>

							</div>

						</div>

						<div class="part2 mb-3">

							<label><?php esc_html_e( 'Who can see these contents?(multiple roles allowed)', 'exlac' );?></label>
							<select id="roles" class="form-control" multiple>
								<?php echo Helper::get_role_names_html( $args['role_names'] ); ?>
							</select>

						</div>

						<div class="part3 mb-3">

							<label><?php esc_html_e( 'Choose how to protect your content', 'exlac' );?></label>
							<select id="protection_type" class="form-select form-control">
								<option value="override_contents" <?php selected( 'override_contents' == $args['protection_type'] );?>><?php esc_html_e( 'Override Contents', 'exlax' );?></option>
								<option value="redirect" <?php selected( 'redirect' == $args['protection_type'] );?>><?php esc_html_e( 'Redirect', 'exlax' );?></option>
							</select>

						</div>

						<div class="part4 mb-3" id="override_contents">

							<label for="heymehedi_the_title" class="form-label">
								<?php esc_html_e( 'Replace Default Title', 'exlac' );?>
								<span class="heymehedi_helper_text" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php esc_attr_e( 'Use the_title by %%title%%', 'exlax' );?>"><?php esc_html_e( '?', 'exlac' );?></span>
							</label>
							<input id="heymehedi_the_title" type="text" value="<?php echo wp_kses_post( $args['the_title'] ); ?>" placeholder="<?php esc_attr_e( 'Prefix %%title%% Suffix', 'exlax' );?>" class="form-control">

							<label for="heymehedi_the_excerpt" class="form-label">
								<?php esc_html_e( 'Replace Default Excerpt', 'exlac' );?>
								<span class="heymehedi_helper_text" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php esc_attr_e( 'Use the_content by %%excerpt%%', 'exlax' );?>"><?php esc_html_e( '?', 'exlac' );?></span>
							</label>
							<textarea class="form-control" name="heymehedi_the_excerpt" id="heymehedi_the_excerpt" rows="5"><?php echo wp_kses_post( $args['the_excerpt'] ); ?></textarea>

							<label for="heymehedi_custom_editor" class="form-label">
								<?php esc_html_e( 'Replace Default Description', 'exlac' );?>
								<span class="heymehedi_helper_text" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php esc_attr_e( 'Use the_content by %%content%%', 'exlax' );?>"><?php esc_html_e( '?', 'exlac' );?></span>
							</label>
							<?php Helper::get_text_editor( $args['the_content'] );?>

						</div>


						<div class="part4 mb-3" id="redirect">

							<label for="redirection_type"><?php esc_html_e( 'Where will they be taken? ', 'exlac' );?></label>
							<select id="redirection_type" class="form-select form-control">
								<option value="homepage" <?php selected( 'homepage' == $args['redirection_type'] );?>><?php esc_html_e( 'Home Page', 'exlac' );?></option>
								<option value="custom_url" <?php selected( 'custom_url' == $args['redirection_type'] );?>><?php esc_html_e( 'Custom URL', 'exlac' );?></option>
							</select>

							<div class="custom_url_box">
								<label for="custom_url"><?php esc_html_e( 'Redirect URL', 'exlac' );?></label>
								<input type="url" placeholder="<?php esc_html_e( 'http://your-url.com', 'exlac' );?>" class="form-control" id="custom_url" value="<?php echo wp_kses_post( $args['custom_url'] ); ?>">
							</div>

						</div>

						<p class="submit">
							<input type="submit" name="submit" id="heymehedi-submit" class="button button-primary" value="<?php esc_attr_e( 'Save Changes', 'exlac' );?>">
						</p>

						<p id="heymehedi-msg"></p>

					</div>

					<div class="col-md-6">

						<div class="part4">

							<h4><?php esc_html_e( 'Selected Items', 'exlac' );?></h4>

							<label for="heymehedi-search_bar_selected" class="form-label"><?php esc_html_e( 'Type the title or ID', 'exlac' );?></label>
							<input id="heymehedi-search_bar_selected" type="text" class="form-control" placeholder="<?php esc_attr_e( 'Search Here...', 'exlac' );?>">

							<div id="heymehedi-selected_items-wrapper">

								<table id="heymehedi-selected_items_table">

									<thead>

										<tr>
											<th class="text-center"><?php esc_html_e( 'Drop', 'exlac' );?></th>
											<th class="text-center"><?php esc_html_e( 'ID', 'exlac' );?></th>
											<th><?php esc_html_e( 'Title', 'exlac' );?></th>
										</tr>

									</thead>

									<tbody id="heymehedi-selected_items_table_body">

										<?php echo Helper::display_items( $args['restrict_in'], 'dashicons-minus', array(), $args[$active_index], true ); ?>

									</tbody>

								</table>

							</div>

						</div>

					</div>

				</div>

			</form>

		</div>

	</div>

</div>