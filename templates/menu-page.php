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

				<?php Helper::get_template_part( 'menu-page/post-type', $args );?>

				<?php Helper::get_template_part( 'menu-page/protection-type', $args );?>

				<?php Helper::get_template_part( 'menu-page/roles', $args );?>

				<?php Helper::get_template_part( 'menu-page/override-contents', $args );?>

				<?php Helper::get_template_part( 'menu-page/redirect', $args );?>

				<p class="submit">
					<input type="submit" name="submit" id="heymehedi-submit" class="button button-primary" value="<?php esc_attr_e( 'Save Changes', 'aio-content-restriction' );?>">
				</p>

				<p id="heymehedi-msg"></p>

			</form>

		</div>

		<div class="col-md-6">

			<?php Helper::get_template_part( 'menu-page/selected-items', $args );?>

		</div>

	</div>

</div>