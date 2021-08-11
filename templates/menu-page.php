<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

use HeyMehedi\AIO_Content_Restriction\Helper;

$active_index = $args['active_index'];
?>
<div class="container-fluid mt-5" id="heymehedi-main">

	<div class="row">

		<div class="col-md-6">

			<form id="heymehedi-form" method="post">

				<div class="part1 mb-3">

					<div class="heymehedi_setting_heading">
						<h1><?php esc_html_e( 'All in One Content Restriction', 'aio-content-restriction' );?></h1>
					</div>

					<label for="post-type" class="form-label"><?php esc_html_e( 'Post Type', 'aio-content-restriction' );?></label>
					<select class="form-select form-control" id="post-type" name="post-type">
						<option value="posts" <?php selected( 'posts' == $args['post_type'] );?>><?php esc_html_e( 'Posts', 'aio-content-restriction' );?></option>
					</select>

					<label for="restriction-in" class="form-label"><?php esc_html_e( 'Restrict in', 'aio-content-restriction' );?></label>
					<select class="form-select form-control" id="restriction-in" name="restriction-in">
						<option value="category" <?php selected( 'category' == $args['restrict_in'] );?>><?php esc_html_e( 'Category', 'aio-content-restriction' );?></option>
						<option value="single_post" <?php selected( 'single_post' == $args['restrict_in'] );?>><?php esc_html_e( 'Single Post', 'aio-content-restriction' );?></option>
					</select>

					<label for="heymehedi-search_bar" class="form-label"><?php esc_html_e( 'Type the title or ID', 'aio-content-restriction' );?></label>
					<input id="heymehedi-search_bar" type="text" class="form-control" placeholder="<?php esc_attr_e( 'Search Here...', 'aio-content-restriction' );?>">

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

				</div>

				<div class="part2 mb-3">

					<label class="form-label" for="protection_type"><?php esc_html_e( 'Choose how to protect your content', 'aio-content-restriction' );?></label>
					<select id="protection_type" class="form-select form-control">
						<option value="override_contents" <?php selected( 'override_contents' == $args['protection_type'] );?>><?php esc_html_e( 'Override Contents', 'aio-content-restriction' );?></option>
						<option value="login_and_back" <?php selected( 'login_and_back' == $args['protection_type'] );?>><?php esc_html_e( 'Login and Back', 'aio-content-restriction' );?></option>
						<option value="redirect" <?php selected( 'redirect' == $args['protection_type'] );?>><?php esc_html_e( 'Redirect', 'aio-content-restriction' );?></option>
					</select>

				</div>

				<div class="part3 mb-3">

					<label class="form-label" for="roles"><?php esc_html_e( 'Who can see these contents?(multiple roles allowed)', 'aio-content-restriction' );?></label>
					<select id="roles" class="form-control" multiple>
						<option></option>
						<?php echo Helper::get_role_names_html( $args['role_names'] ); ?>
					</select>

				</div>

				<div class="part4 mb-3" id="override_contents">

					<label for="heymehedi_the_title" class="form-label">
						<?php esc_html_e( 'Replace Default Title', 'aio-content-restriction' );?>
						<span class="heymehedi_helper_text" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php esc_attr_e( 'Use the_title by %%title%%', 'aio-content-restriction' );?>"><?php esc_html_e( '?', 'aio-content-restriction' );?></span>
					</label>
					<input id="heymehedi_the_title" type="text" value="<?php echo wp_kses_post( $args['the_title'] ); ?>" placeholder="<?php esc_attr_e( 'Prefix %%title%% Suffix', 'aio-content-restriction' );?>" class="form-control">

					<label for="heymehedi_the_excerpt" class="form-label">
						<?php esc_html_e( 'Replace Default Excerpt', 'aio-content-restriction' );?>
						<span class="heymehedi_helper_text" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php esc_attr_e( 'Use the_content by %%excerpt%%', 'aio-content-restriction' );?>"><?php esc_html_e( '?', 'aio-content-restriction' );?></span>
					</label>
					<textarea class="form-control" name="heymehedi_the_excerpt" id="heymehedi_the_excerpt" rows="5"><?php echo wp_kses_post( $args['the_excerpt'] ); ?></textarea>

					<label for="heymehedi_custom_editor" class="form-label">
						<?php esc_html_e( 'Replace Default Description', 'aio-content-restriction' );?>
						<span class="heymehedi_helper_text" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php esc_attr_e( 'Use the_content by %%content%%', 'aio-content-restriction' );?>"><?php esc_html_e( '?', 'aio-content-restriction' );?></span>
					</label>
					<?php Helper::get_text_editor( $args['the_content'] );?>

				</div>


				<div class="part4 mb-3" id="redirect">

					<label class="form-label" for="redirection_type"><?php esc_html_e( 'Where will they be taken? ', 'aio-content-restriction' );?></label>
					<select id="redirection_type" class="form-select form-control">
						<option value="homepage" <?php selected( 'homepage' == $args['redirection_type'] );?>><?php esc_html_e( 'Home Page', 'aio-content-restriction' );?></option>
						<option value="custom_url" <?php selected( 'custom_url' == $args['redirection_type'] );?>><?php esc_html_e( 'Custom URL', 'aio-content-restriction' );?></option>
					</select>

					<div class="custom_url_box">
						<label class="form-label" for="custom_url"><?php esc_html_e( 'Redirect URL', 'aio-content-restriction' );?></label>
						<input type="url" placeholder="<?php esc_html_e( 'http://your-url.com', 'aio-content-restriction' );?>" class="form-control" id="custom_url" value="<?php echo wp_kses_post( $args['custom_url'] ); ?>">
					</div>

				</div>

				<p class="submit">
					<input type="submit" name="submit" id="heymehedi-submit" class="button button-primary" value="<?php esc_attr_e( 'Save Changes', 'aio-content-restriction' );?>">
				</p>

				<p id="heymehedi-msg"></p>

			</form>

		</div>

		<div class="col-md-6">

			<div class="part5">

				<h2><?php esc_html_e( 'Selected items', 'aio-content-restriction' );?></h2>

				<label for="heymehedi-search_bar_selected" class="form-label"><?php esc_html_e( 'Type the title or ID', 'aio-content-restriction' );?></label>
				<input id="heymehedi-search_bar_selected" type="text" class="form-control" placeholder="<?php esc_attr_e( 'Search Here...', 'aio-content-restriction' );?>">

				<div id="heymehedi-items-wrapper-selected">

					<table id="heymehedi-selected_items_table">

						<thead>

							<tr>
								<th class="text-center"><?php esc_html_e( 'Drop', 'aio-content-restriction' );?></th>
								<th class="text-center"><?php esc_html_e( 'ID', 'aio-content-restriction' );?></th>
								<th><?php esc_html_e( 'Title', 'aio-content-restriction' );?></th>
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

</div>