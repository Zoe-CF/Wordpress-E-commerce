<?php
/**
 * remax-store functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     Remax_Store
 * @author      Themerelic
 * @copyright   Copyright (c) 2018, Themerelic
 * @link        http://themerelic.com
 * @since       Remax_Store 1.0.0
 * */


/**
 * Define Constants
 */
define( 'REMAX_STORE_THEME_VERSION', '1.0.0' );
define( 'REMAX_STORE_THEME_DIR', trailingslashit ( get_template_directory() ) );
define( 'REMAX_STORE_THEME_URI', trailingslashit ( get_template_directory_uri() ));
define( 'REMAX_STORE_THEME_IMG', trailingslashit ( get_template_directory_uri() ). 'assets/images/' );

/**
 * require class file
 */
require_once REMAX_STORE_THEME_DIR . 'themerelic/core/class-remax-store-after-setup-theme.php';
require_once REMAX_STORE_THEME_DIR . 'themerelic/core/class-register-widget.php';
require_once REMAX_STORE_THEME_DIR . 'themerelic/core/class-remax-store-enqueue-scripts.php';
require_once REMAX_STORE_THEME_DIR . 'themerelic/core/theme-hooks.php';
require_once REMAX_STORE_THEME_DIR . 'themerelic/core/extras.php';
require_once REMAX_STORE_THEME_DIR . 'themerelic/core/class-remax-store-loop.php';
require_once REMAX_STORE_THEME_DIR . 'themerelic/core/common-functions.php';
require_once REMAX_STORE_THEME_DIR . 'themerelic/core/class-tgm-plugin-activation.php';



require_once REMAX_STORE_THEME_DIR . 'themerelic/admin/class-remax-store-admin.php';





/**
 * Default Require File
 */
require REMAX_STORE_THEME_DIR . 'themerelic/inc/custom-header.php';
require REMAX_STORE_THEME_DIR . 'themerelic/inc/template-tags.php';
require REMAX_STORE_THEME_DIR . 'themerelic/inc/template-functions.php';
require REMAX_STORE_THEME_DIR . 'themerelic/inc/customizer.php';



/**
 * Woocommerce Compitable file
 */
if ( class_exists( 'WooCommerce' ) ) {
	require REMAX_STORE_THEME_DIR . 'themerelic/hooks/woocommerce.php';
}
require REMAX_STORE_THEME_DIR . 'themerelic/hooks/woo-functions.php';

/**
 * Customizer Settings
 */
require REMAX_STORE_THEME_DIR . '/themerelic/customizer/custom-controls/custom-control.php';
require REMAX_STORE_THEME_DIR . '/themerelic/customizer/customizer.php';