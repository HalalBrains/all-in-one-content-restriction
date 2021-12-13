<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.3
 */

use HeyMehedi\All_In_One_Content_Restriction\Helper;

$active_index = isset( $args['active_index'] ) ? $args['active_index'] : '';
?>
<div class="container mt-5" id="heymehedi-main">

	<div class="row">

		<div class="col-md-12" style="margin: 0 auto;">

	  	<form id="msform">

          <!-- fieldsets -->
          <?php Helper::get_template_part( 'menu-page/steps/restriction-rule', $args );?>
          <?php Helper::get_template_part( 'menu-page/steps/access-restriction', $args );?>
          <?php Helper::get_template_part( 'menu-page/steps/content-shield-option', $args );?>
		  
		  <p id="heymehedi-msg"></p>

        </form>

		</div>

	</div>

</div>