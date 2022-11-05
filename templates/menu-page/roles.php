<?php
/**
 * @author  HeyMehedi
 * @since   1.0
 * @version 1.6.4
 */

use HeyMehedi\All_In_One_Content_Restriction\Markup_Manager;

$user_restriction_type = isset( $args['user_restriction_type'] ) ? $args['user_restriction_type'] : 'role_names';
$role_names            = isset( $args['role_names'] ) ? $args['role_names'] : array();
$specify_users         = isset( $args['specify_users'] ) ? $args['specify_users'] : array();
?>
<div class="roles mb-3" id="user_restriction_type_wrapper">

	<label class="form-label" for="user_restriction_type"><?php esc_html_e( 'Select who should have access to this content', 'all-in-one-content-restriction' );?></label>
	<select id="user_restriction_type" class="form-control">
		<option value="roles" <?php selected( 'roles' == $user_restriction_type );?>><?php esc_html_e( 'By User Roles', 'all-in-one-content-restriction' );?></option>
		<option value="specify_users" <?php selected( 'specify_users' == $user_restriction_type );?>><?php esc_html_e( 'By Specified Users', 'all-in-one-content-restriction' );?></option>
	</select>

	<div class="roles-group">
		<label class="form-label" for="roles"><?php esc_html_e( 'Select Roles', 'all-in-one-content-restriction' );?></label>
		<select id="roles" class="form-control" multiple>
			<option></option>
			<?php echo Markup_Manager::get_role_names_html( $role_names ); ?>
		</select>
	</div>

	<div class="specify_users-group">
		<label class="form-label" for="specify_users"><?php esc_html_e( 'Select Users', 'all-in-one-content-restriction' );?></label>
		<select id="specify_users" class="form-control" multiple>
			<option></option>
			<?php echo Markup_Manager::get_specified_user_html( $specify_users ); ?>
		</select>
	</div>

</div>