<?php
/**
 * @author  HeyMehedi
 * @since   1.6.6
 * @version 1.6.6
 */

use HeyMehedi\All_In_One_Content_Restriction\Helper;
?>

<style>#wpcontent{
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

<div class="text-dark text-center p-3" style="background: #ddd !important;">
   Find this plugin useful? Help others discover this plugin by leaving  a <a href="https://wordpress.org/support/plugin/all-in-one-content-restriction/reviews/?rate=5#new-post" target="_blank" rel="noopener noreferrer">review</a> on WordPress.org
</div>

<div class="text-dark p-3" style="background-color: #e7e7e7 !important;">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 align-items-center d-flex">
				<img class="me-3" src="<?php echo Helper::get_file_uri( 'admin/images/dashboard-logo.svg' ); ?>" alt="" width="48" height="38">
				<h2>AIO Content Restriction</h2>
				<sup class="text-light bg-dark m-2 rounded" style="padding: 13px 7px !important;">v1.6.5</sup>
			</div>
		</div>
	</div>
</div>

<!-- Welcome message -->
<div class="p-3">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 border-bottom">
				<h2>Hello <?php echo esc_html( get_the_author_meta('display_name', get_current_user_id()) );?>!</h2>
				<p>Welcome back to the dashboard. Take a look at the recent update.</p>
			</div>
		</div>
	</div>
</div>

<!-- Changelog -->
<div class="p-3 pt-5">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h4>Version 1.6.5</h4>
				<p>December 12, 2022</p>
			</div>
			<ul class="changelogs">
				<li class="bg-white mb-3 rounded">
					<span class="badge new bg-success text-white p-2 m-3 mb-0 rounded">New</span>
					<ul class="list-group list-group-flush m-3">
						<li class="list-group-item">Introduced the payment gateways</li>
						<li class="list-group-item">Introduced the payment gateways</li>
					</ul>
				</li>
				<li class="bg-white mb-3 rounded">
					<span class="badge new bg-danger text-white p-2 m-3 mb-0 rounded">Fix</span>
					<ul class="list-group list-group-flush m-3">
						<li class="list-group-item">Introduced the payment gateways</li>
						<li class="list-group-item">Introduced the payment gateways</li>
					</ul>
				</li>
				<li class="bg-white mb-3 rounded">
					<span class="badge new bg-info text-white p-2 m-3 mb-0 rounded">Improvement</span>
					<ul class="list-group list-group-flush m-3">
						<li class="list-group-item">Introduced the payment gateways</li>
						<li class="list-group-item">Introduced the payment gateways</li>
						<li class="list-group-item">Introduced the payment gateways</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>

<!-- Resources -->
<div class="p-3 pt-5 resources d-none">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<div class="card" style="max-width: 100%;">
					<div class="card-body extra-icon documentation">
						<h5 class="card-title text-success">Documentation</h5>
						<p class="card-text">Our documentation is simple and functional with full details and it cover all essential aspects. It's available on the plugin website.</p>
						<a href="#" class="btn btn-success">View Knowledge Base</a>
						<div class="bg-right-bottom"></div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card" style="max-width: 100%;">
					<div class="card-body extra-icon support">
						<h5 class="card-title text-danger">Support</h5>
						<p class="card-text">You don't need to register anywhere for support anymore. Just click the following button, and the chat box will open up to ask all your different questions using our channels.</p>
						<a href="#" class="btn btn-danger">Open Ticket</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Footer Credit -->
<div class="p-3">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h4>HalalBrains</h4>
				<div class="border-bottom"></div>
				<p>Thanks you for choosing AIO Content Restriction. We are honored and fully dedicated to making your experience perfect.</p>
			</div>
		</div>
	</div>
</div>