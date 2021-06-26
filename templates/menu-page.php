<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.0
 */

use HeyMehedi\Content_Restriction\Helper;
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

						<?php Helper::get_template_part( 'menu-page/not-selected-table' );?>

					</div>

					<div class="col-md-6">

						<?php Helper::get_template_part( 'menu-page/selected-table' )?>

					</div>

					<p class="submit"><input type="submit" name="submit" id="heymehedi-submit" class="button button-primary" value="<?php esc_attr_e( 'Save Changes', 'content-restriction' )?>"></p>

				</div>

			</form>

		</div>

	</div>

</div>