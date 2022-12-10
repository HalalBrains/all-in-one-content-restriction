<?php
/**
 * @author  HeyMehedi
 * @since   1.6.6
 * @version 1.6.6
 */

use HeyMehedi\All_In_One_Content_Restriction\Helper;
?>

<?php Helper::get_template_part_admin( 'header-banner' );?>

<!-- Welcome message -->
<div class="container pt-3">
	<div class="row">
		<div class="col-md-12 border-bottom">
			<h4 class="text-dark fs-4">Hello <?php echo esc_html( get_the_author_meta( 'display_name', get_current_user_id() ) ); ?>!</h4>
			<p class="fs-6">Welcome back to the dashboard. Take a look at the recent update.</p>
		</div>
	</div>
</div>

<!-- Changelog -->
<div class="container pt-5">
	<div class="row">
		<div class="col-md-12">
			<h5 class="fs-5">Version 1.6.5</h5>
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

<!-- Resources -->
<div class="p-3 pt-5 resources d-none">
	<div class="container">
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

<?php Helper::get_template_part_admin( 'footer-message' );