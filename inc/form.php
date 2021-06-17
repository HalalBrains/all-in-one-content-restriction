<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

namespace HeyMehedi\Content_Restriction;

class Form {

	protected static $instance = null;

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function render() {
		?>

		<div class="container">
			<div class="row">
				<div class="col-md-6 pt-5">

					<div class="heymehedi_setting_heading pb-2">
						<h2>Content Restriction</h2>
					</div>

					<form id="heymehedi-form" method="post">

						<label for="exampleFormControlInput1" class="form-label"><?php esc_attr_e( 'Post Type', 'content-restriction' );?></label>
						<select class="form-select form-control" id="post-type" name="post-type">
							<option value="post" selected><?php esc_attr_e( 'Post', 'content-restriction' ); ?></option>
							<option value="page"><?php esc_attr_e( 'Page', 'content-restriction' ); ?></option>
						</select>

						<label for="exampleFormControlInput2" class="form-label"><?php esc_attr_e( 'Restriction Wise', 'content-restriction' );?></label>
						<select class="form-select form-control" id="restriction-wise" name="restriction-wise">
							<option value="category" selected><?php esc_attr_e( 'Category', 'content-restriction' ); ?></option>
							<option value="single_post"><?php esc_attr_e( 'Single Post', 'content-restriction' ); ?></option>
						</select>

						<div id="items-list">
							
							<label for="exampleFormControlInput1" class="form-label"><?php esc_attr_e( 'Search Here', 'content-restriction' );?></label>
							
							<input id="myInput" type="text" class="form-control" placeholder="Search..">

							<table>
								<thead>
									<tr>
										<th>Add</th>
										<th>Id</th>
										<th>Title</th>
									</tr>
								</thead>
								
								<tbody id="myTable"></tbody>
							</table>	
						</div>

						<label for="exampleFormControlInput1" class="form-label">Email address</label>
						<input class="form-control" type="text" id="hide-content"  name="hide-content" value="<?php echo get_option( 'hide-content' ); ?>">

						<p class="submit"><input type="submit" name="submit" id="heymehedi-submit" class="button button-primary" value="<?php esc_attr_e( 'Save Changes', 'content-restriction' )?>"></p>
					
					</form>

				</div>
			</div>
		</div>

	<?php }
}