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
				<div class="col-md-8">
				
					<div class="heymehedi_setting_tab_menu">
						<h1>Hello World</h1>
					</div>

					<form id="heymehedi-form" method="post">

						<label for="exampleFormControlInput1" class="form-label">Post Type</label>
						<select class="form-select" name="post-type">
							<option selected>Open this select menu</option>
							<option value="1">One</option>
							<option value="2">Two</option>
							<option value="3">Three</option>
						</select>

						<label for="exampleFormControlInput1" class="form-label">Email address</label>
						<input class="form-control" type="text" id="hide-content"  name="hide-content" value="<?php echo get_option( 'hide-content' ); ?>">

						<label for="exampleFormControlInput1" class="form-label">Email address</label>
						<input class="form-control" type="text" id="hide-content"  name="hide-content" value="<?php echo get_option( 'hide-content' ); ?>">

						<p class="submit"><input type="submit" name="submit" id="heymehedi-submit" class="button button-primary" value="<?php esc_attr_e( 'Save Changes', 'content-restriction' )?>"></p>
					</form>

				</div>
			</div>
		</div>
		<?php
}
}