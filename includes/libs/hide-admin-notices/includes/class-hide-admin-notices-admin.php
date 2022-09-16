<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://heymehedi.com
 * @since      1.0.0
 *
 * @package    HeyMehedi_Hide_Admin_Notices
 * @subpackage HeyMehedi_Hide_Admin_Notices/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    HeyMehedi_Hide_Admin_Notices
 * @subpackage HeyMehedi_Hide_Admin_Notices/admin
 * @author     HeyMehedi <hi@heymehedi.com>
 */
class HeyMehedi_Hide_Admin_Notices_Admin {

	/**
	 * Register the CSS and JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		$minified = '.min';
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG === true || true ) {
			$minified = '';
		}

		wp_enqueue_style( HEYMEHEDI_HIDE_ADMIN_NOTICES_NAME,
			HEYMEHEDI_HIDE_ADMIN_NOTICES_BASEURL . 'assets/css/hide-admin-notices' . $minified . '.css',
			array(), HEYMEHEDI_HIDE_ADMIN_NOTICES_VERSION );
		wp_register_script( HEYMEHEDI_HIDE_ADMIN_NOTICES_NAME,
			HEYMEHEDI_HIDE_ADMIN_NOTICES_BASEURL . 'assets/js/hide-admin-notices' . $minified . '.js',
			array( 'jquery' ),
			HEYMEHEDI_HIDE_ADMIN_NOTICES_VERSION, true );
		wp_enqueue_script( HEYMEHEDI_HIDE_ADMIN_NOTICES_NAME );
	}

	/**
	 * Modify plugin row meta.
	 *
	 * @since    1.0.0
	 */
	public function plugin_row_meta( $links, $file ) {
		if ( HEYMEHEDI_HIDE_ADMIN_NOTICES_BASENAME === $file ) {
			$row_meta = array(
				'donate' => '<a target="_blank" href="' . esc_url( HEYMEHEDI_HIDE_ADMIN_NOTICES_DONATE_LINK ) .
				'" aria-label="' . esc_attr__( 'Donate a $1', 'all-in-one-content-restriction' ) .
				'">' . esc_html__( 'Donate a $1', 'all-in-one-content-restriction' ) . '</a>',
			);

			return array_merge( $links, $row_meta );
		}

		return (array) $links;
	}

	/**
	 * Modify plugin actions.
	 *
	 * @param $links
	 *
	 * @return array
	 * @since    1.2.0
	 *
	 */
	public function plugin_action_links( $links ) {
		$rate_link = array(
			'rate' => '<a target="_blank" href="' . esc_url( HEYMEHEDI_HIDE_ADMIN_NOTICES_RATE_LINK ) .
			'" aria-label="' . esc_attr__( 'Like it?', 'all-in-one-content-restriction' ) .
			'">' . esc_html__( 'Like it?', 'all-in-one-content-restriction' ) . '</a>',
		);

		return array_merge( $links, $rate_link );
	}

	/**
	 * Plugin placeholder elements.
	 *
	 * @return string
	 */
	public function admin_notices() {
		?>
    <div id="hidden-admin-notices-panel" class="hidden" tabindex="-1"
         aria-label="<?php echo esc_attr__( 'Notifications Tab', 'all-in-one-content-restriction' ); ?> "></div>
    <div id="hidden-admin-notices-link-wrap" class="hide-if-no-js">
      <button type="button" id="hidden-admin-notices-link"
              class="button" aria-controls="hidden-admin-notices-panel" aria-expanded="false">
        <span class="hidden-admin-notices-link-icon" aria-hidden="true"></span>
        <span class="hidden-admin-notices-link-text-show"
          aria-label="<?php echo esc_html__( 'Show Notices', 'all-in-one-content-restriction' ); ?>"><?php echo esc_html__( 'Show Notices', 'all-in-one-content-restriction' ); ?></span>
        <span class="hidden-admin-notices-link-text-hide"
          aria-label="<?php echo esc_html__( 'Hide Notices', 'all-in-one-content-restriction' ); ?>"><?php echo esc_html__( 'Hide Notices', 'all-in-one-content-restriction' ); ?></span>
      </button>
    </div>
    <?php
}
}