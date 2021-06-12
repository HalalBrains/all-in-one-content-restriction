<?php
/*
Plugin Name: Content Restriction
Plugin URI: https://github.com/HeyMehedi/content-restriction
Description: Content Restriction is a lightweight and powerful plugin that allows you to take complete control of your website’s content by restricting access to pages/posts to logged in users, specific user roles or to logged out users.
Author: HeyMehedi
Author URI: https://heymehedi.com
version: 1.0
 */

namespace HeyMehedi;

class Content_Restriction {

	public static $base_dir;
	public static $inc_dir;
	public static $version;
	public static $author_uri;
	public static $prefix;
	public static $options;

	public function __construct() {

		self::$base_dir = WP_PLUGIN_DIR . '/content-restriction';
		self::$inc_dir  = self::$base_dir . '/inc/';

		$data             = $this->get_data();
		self::$version    = $data['Version'];
		self::$author_uri = $data['AuthorURI'];
		self::$prefix     = 'content-restriction';
		self::$options    = 'content-restriction';

		$this->includes();

	}

	public function includes() {
		require_once self::$base_dir . '/inc/helper.php';
		require_once self::$base_dir . '/inc/loader.php';
		require_once self::$base_dir . '/inc/scripts.php';
		require_once self::$base_dir . '/inc/query.php';
		require_once self::$base_dir . '/inc/form.php';
		require_once self::$base_dir . '/inc/update.php';
	}

	public function get_data() {
		$file_path = self::$base_dir . '/content-restriction.php';

		return get_file_data( $file_path, array( 'Version' => 'Version', 'AuthorURI' => 'Author URI' ) );
	}
}

new Content_Restriction();

add_action( 'wp_ajax_custom_action', 'custom_action' );
add_action( 'wp_ajax_nopriv_custom_action', 'custom_action' );
function custom_action() {
    // A default response holder, which will have data for sending back to our js file
    $response = array(
    	'error' => false,
    );

    // Example for creating an response with error information, to know in our js file
    // about the error and behave accordingly, like adding error message to the form with JS
    if (trim($_POST['email']) == '') {
    	$response['error'] = true;
    	$response['error_message'] = 'Email is required';

    	// Exit here, for not processing further because of the error
    	exit(json_encode($response));
    }

    // ... Do some code here, like storing inputs to the database, but don't forget to properly sanitize input data!

    // Don't forget to exit at the end of processing
    exit(json_encode($response));
}
