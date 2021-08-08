<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

use HeyMehedi\Exlac\Helper;
use HeyMehedi\Exlac\Strings;

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

								<h2><?php echo esc_html( Strings::get()[100] ); ?></h2>

							</div>

							<label for="post-type" class="form-label"><?php echo esc_html( Strings::get()[102] ); ?></label>
							<select class="form-select form-control" id="post-type" name="post-type">
								<option value="post" <?php selected( 'post' == $args['post_type'] );?> ><?php echo esc_html( Strings::get()[111] ); ?></option>
							</select>

							<label for="restriction-in" class="form-label"><?php echo esc_html( Strings::get()[103] ); ?></label>
							<select class="form-select form-control" id="restriction-in" name="restriction-in">
								<option value="category" <?php selected( 'category' == $args['restrict_in'] );?>><?php echo esc_html( Strings::get()[112] ); ?></option>
								<option value="single_post" <?php selected( 'single_post' == $args['restrict_in'] );?>><?php echo esc_html( Strings::get()[113] ); ?></option>
							</select>

							<label for="heymehedi-search_bar" class="form-label"><?php echo esc_html( Strings::get()[104] ); ?></label>
							<input id="heymehedi-search_bar" type="text" class="form-control" placeholder="<?php echo esc_attr( Strings::get()[114] ); ?>">

							<div id="heymehedi-items-wrapper">

								<table id="heymehedi-items_table">

									<thead>

										<tr>
											<th class="text-center"><?php echo esc_html( Strings::get()[105] ); ?></th>
											<th class="text-center"><?php echo esc_html( Strings::get()[106] ); ?></th>
											<th><?php echo esc_html( Strings::get()[107] ); ?></th>
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
								<?php echo esc_html( Strings::get()[116] ); ?>
								<span class="heymehedi_helper_text" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo esc_attr( Strings::get()[117] ); ?>"><?php esc_html_e( '?', 'exlac' );?></span>
							</label>
							<input id="heymehedi_the_title" type="text" value="<?php echo wp_kses_post( $args['the_title'] ); ?>" placeholder="<?php echo esc_html( Strings::get()[118] ); ?>" class="form-control">

							<label for="heymehedi_the_excerpt" class="form-label">
								<?php echo esc_html( Strings::get()[121] ); ?>
								<span class="heymehedi_helper_text" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo esc_attr( Strings::get()[122] ); ?>"><?php esc_html_e( '?', 'exlac' );?></span>
							</label>
							<textarea class="form-control" name="heymehedi_the_excerpt" id="heymehedi_the_excerpt" rows="5"><?php echo wp_kses_post( $args['the_excerpt'] ); ?></textarea>

							<label for="heymehedi_custom_editor" class="form-label">
								<?php echo esc_html( Strings::get()[115] ); ?>
								<span class="heymehedi_helper_text" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo esc_attr( Strings::get()[119] ); ?>"><?php esc_html_e( '?', 'exlac' );?></span>
								</label>
							<?php Helper::get_text_editor( $args['the_content'] );?>

						</div>


						<div class="part4 mb-3" id="redirect">

							<label for="redirection_type"><?php esc_html_e( 'Where will they be taken? ', 'exlac' );?></label>
							<select id="redirection_type" class="form-select form-control">
								<option value="login" <?php selected( 'login' == $args['redirection_type'] );?>><?php esc_html_e( 'Login &amp; Back', 'exlac' );?></option>
								<option value="homepage" <?php selected( 'homepage' == $args['redirection_type'] );?>><?php esc_html_e( 'Home Page', 'exlac' );?></option>
								<option value="custom_url" <?php selected( 'custom_url' == $args['redirection_type'] );?>><?php esc_html_e( 'Custom URL', 'exlac' );?></option>
							</select>

						</div>

						<p class="submit">
							<input type="submit" name="submit" id="heymehedi-submit" class="button button-primary" value="<?php echo esc_attr( Strings::get()[108] ); ?>">
						</p>

						<p id="heymehedi-msg"></p>

					</div>

					<div class="col-md-6">

						<div class="part4">

							<h4><?php echo esc_html( Strings::get()[109] ); ?></h4>

							<label for="heymehedi-search_bar_selected" class="form-label"><?php echo esc_html( Strings::get()[104] ); ?></label>
							<input id="heymehedi-search_bar_selected" type="text" class="form-control" placeholder="<?php echo esc_attr( Strings::get()[114] ); ?>">

							<div id="heymehedi-selected_items-wrapper">

								<table id="heymehedi-selected_items_table">

									<thead>

										<tr>
											<th class="text-center"><?php echo esc_html( Strings::get()[120] ); ?></th>
											<th class="text-center"><?php echo esc_html( Strings::get()[106] ); ?></th>
											<th><?php echo esc_html( Strings::get()[107] ); ?></th>
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