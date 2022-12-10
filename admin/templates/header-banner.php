<?php
/**
 * @author  HeyMehedi
 * @since   1.6.6
 * @version 1.6.6
 */

use HeyMehedi\All_In_One_Content_Restriction;
use HeyMehedi\All_In_One_Content_Restriction\Helper;
?>
<style>
	#wpcontent{
		padding: 0;
	} body {
		background-color: #f0f0f1;
	}
	.list-group-flush .list-group-item {
		border: 0;
		padding: 0;
		padding-bottom: 10px;
	}

	.extra-icon {
		background-repeat: no-repeat;
		background-position: bottom right;
		min-height: 210px;
		background-size: 120px;
	}

	.extra-icon .card-text {
		max-width: 450px;
	}

	.extra-icon .card-title {
		padding-bottom: 10px;
	}
	.extra-icon.documentation {
		background-image: url("<?php echo Helper::get_file_uri( 'admin/images/dashboard-doc.svg' ) ?>");
	}
	.extra-icon.support {
		background-image: url("<?php echo Helper::get_file_uri( 'admin/images/dashboard-support.svg' ) ?>");
	}
	div#wpfooter {
		display: none;
	}
	.border-bottom {
		border-bottom: 1px solid #dee2e6!important;
		border-width: 2px !important;
		margin-bottom: 5px;
	}
	#wpbody-content {
		padding-bottom: 0px;
	}
</style>
<div class="d-flex align-items-center p-1 bg-primary shadow-sm"></div>

<div class="text-dark text-center text-dark p-3" style="background: #ddd !important;">
  <p class="m-0" >Find this plugin useful? Help others discover this plugin by leaving  a <a href="https://wordpress.org/support/plugin/all-in-one-content-restriction/reviews/?rate=5#new-post" target="_blank" rel="noopener noreferrer">review</a> on WordPress.org</p>
</div>

<div class="text-dark p-3" style="background-color: #e7e7e7 !important;">
	<div class="container">
		<div class="row">
			<div class="col-md-12 align-items-center d-flex">
				<img class="me-3" src="<?php echo Helper::get_file_uri( 'admin/images/dashboard-header-icon.svg' ); ?>" alt="" width="48" height="38">
				<h3 class="m-0 fs-3" style="font-weight: 400;">AIO Content Restriction</h3>
				<sup class="text-light bg-dark m-2 rounded" style="padding: 13px 7px !important;">v<?php echo esc_html( All_In_One_Content_Restriction::$version ); ?></sup>
			</div>
		</div>
	</div>
</div>