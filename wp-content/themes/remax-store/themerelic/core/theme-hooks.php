<?php
/**
 * Theme Hook Alliance hook stub list.
 *
 * @see  https://github.com/zamoose/themehookalliance
 *
 * @package     Remax_Store
 * @author      Themerelic
 * @copyright   Copyright (c) 2018, Themerelic
 * @link        http://themerelic.com
 * @since       Remax_Store 1.0.0
 * */


/**
 * Define the version of THA support, in case that becomes useful down the road.
 */
define( 'remax_store_HOOKS_VERSION', '1.0-draft' );

/**
 * Themes and Plugins can check for remax_store_hooks using current_theme_supports( 'remax_store_hooks', $hook )
 * to determine whether a theme declares itself to support this specific hook type.
 *
 * Example:
 * <code>
 * 		// Declare support for all hook types
 * 		add_theme_support( 'remax_store_hooks', array( 'all' ) );
 *
 * 		// Declare support for certain hook types only
 * 		add_theme_support( 'remax_store_hooks', array( 'header', 'content', 'footer' ) );
 * </code>
 */
add_theme_support( 'remax_store_hooks', array(

	/**
	 * As a Theme developer, use the 'all' parameter, to declare support for all
	 * hook types.
	 * Please make sure you then actually reference all the hooks in this file,
	 * Plugin developers depend on it!
	 */
	'all',

	/**
	 * Themes can also choose to only support certain hook types.
	 * Please make sure you then actually reference all the hooks in this type
	 * family.
	 *
	 * When the 'all' parameter was set, specific hook types do not need to be
	 * added explicitly.
	 */
	'html',
	'body',
	'head',
	'header',
	'content',
	'entry',
	'comments',
	'sidebars',
	'sidebar',
	'footer',

	/**
	 * If/when WordPress Core implements similar methodology, Themes and Plugins
	 * will be able to check whether the version of THA supplied by the theme
	 * supports Core hooks.
	 */
	//'core',
) );

/**
 * Determines, whether the specific hook type is actually supported.
 *
 * Plugin developers should always check for the support of a <strong>specific</strong>
 * hook type before hooking a callback function to a hook of this type.
 *
 * Example:
 * <code>
 * 		if ( current_theme_supports( 'remax_store_hooks', 'header' ) )
 * 	  		add_action( 'remax_store_head_top', 'prefix_header_top' );
 * </code>
 *
 * @param bool $bool true
 * @param array $args The hook type being checked
 * @param array $registered All registered hook types
 *
 * @return bool
 */
function remax_store_current_theme_supports( $bool, $args, $registered ) {
	return in_array( $args[0], $registered[0] ) || in_array( 'all', $registered[0] );
}
add_filter( 'current_theme_supports-remax_store_hooks', 'remax_store_current_theme_supports', 10, 3 );

/**
 * HTML <html> hook
 * Special case, useful for <DOCTYPE>, etc.
 * $remax_store_supports[] = 'html;
 */
function remax_store_html_before() {
	do_action( 'remax_store_html_before' );
}
/**
 * HTML <body> hooks
 * $remax_store_supports[] = 'body';
 */
function remax_store_body_top() {
	do_action( 'remax_store_body_top' );
}

function remax_store_body_bottom() {
	do_action( 'remax_store_body_bottom' );
}

/**
 * HTML <head> hooks
 *
 * $remax_store_supports[] = 'head';
 */
function remax_store_head_top() {
	do_action( 'remax_store_head_top' );
}

function remax_store_head_bottom() {
	do_action( 'remax_store_head_bottom' );
}

/**
 * Semantic <header> hooks
 *
 * $remax_store_supports[] = 'header';
 */
function remax_store_header_before() {
	do_action( 'remax_store_header_before' );
}

function remax_store_header() {
	do_action( 'remax_store_header' );
}

function remax_store_site_branding() {
	do_action( 'remax_store_site_branding' );
}

function remax_store_menu() {
	do_action( 'remax_store_menu' );
}


function remax_store_header_after() {
	do_action( 'remax_store_header_after' );
}



function remax_store_header_cart() {
	do_action( 'remax_store_header_cart' );
}


/**
 * Semantic <content> hooks
 *
 * $remax_store_supports[] = 'content';
 */
function remax_store_content_before() {
	do_action( 'remax_store_content_before' );
}

function remax_store_content_after() {
	do_action( 'remax_store_content_after' );
}

function remax_store_content_top() {
	do_action( 'remax_store_content_top' );
}

function remax_store_content_bottom() {
	do_action( 'remax_store_content_bottom' );
}

function remax_store_content_while_before() {
	do_action( 'remax_store_content_while_before' );
}

function remax_store_content_while_after() {
	do_action( 'remax_store_content_while_after' );
}

function remax_store_content_loop(){
	do_action('remax_store_content_loop');
}

/**
 * Semantic <entry> hooks
 *
 * $remax_store_supports[] = 'entry';
 */
function remax_store_entry_before() {
	do_action( 'remax_store_entry_before' );
}

function remax_store_entry_after() {
	do_action( 'remax_store_entry_after' );
}

function remax_store_entry_content_before() {
	do_action( 'remax_store_entry_content_before' );
}

function remax_store_entry_content_after() {
	do_action( 'remax_store_entry_content_after' );
}

function remax_store_entry_top() {
	do_action( 'remax_store_entry_top' );
}

function remax_store_entry_bottom() {
	do_action( 'remax_store_entry_bottom' );
}

/**
 * Comments block hooks
 *
 * $remax_store_supports[] = 'comments';
 */
function remax_store_comments_before() {
	do_action( 'remax_store_comments_before' );
}

function remax_store_comments_after() {
	do_action( 'remax_store_comments_after' );
}

/**
 * Semantic <sidebar> hooks
 *
 * $remax_store_supports[] = 'sidebar';
 */
function remax_store_sidebars_before() {
	do_action( 'remax_store_sidebars_before' );
}

function remax_store_sidebars_after() {
	do_action( 'remax_store_sidebars_after' );
}



/**
 * Semantic <footer> hooks
 *
 * $remax_store_supports[] = 'footer';
 */
function remax_store_footer_before() {
	do_action( 'remax_store_footer_before' );
}

function remax_store_footer() {
	do_action( 'remax_store_footer' );
}

function remax_store_footer_widgets() {
	do_action( 'remax_store_footer_widgets' );
}

function remax_store_footer_copyright() {
	do_action( 'remax_store_footer_copyright' );
}

function remax_store_footer_after() {
	do_action( 'remax_store_footer_after' );
}


function remax_store_pagination(){
	do_action('remax_store_number_pagination');
}

function remax_store_social_media(){
	do_action('remax_store_social_media');
}


/**
 * Archive header
 */
function remax_store_archive_header() {
	do_action( 'remax_store_archive_header' );
}


/**
 * 404 Page content template action.
 */
function remax_store_404_content_template() {
	do_action( 'remax_store_404_content_template' );
}



/**
 * Conten Page Loop.
 *
 * Called from page.php
 */
function remax_store_content_page_loop() {
	do_action( 'remax_store_content_page_loop' );
}


/**
 * Custom Breadcrumb Section
 */
function remax_store_breadcrumb() {
	do_action( 'remax_store_breadcrumb' );
}


/**
 * Homepage Slider Section
 */
function remax_store_homepage_slider_section() {
	do_action( 'remax_store_homepage_slider_section' );
}

/**
 * Homepage Products Category Section
 */
function remax_store_homepage_category_section() {
	do_action( 'remax_store_homepage_category_section' );
}

/**
 * Homepage Hotoffer Section
 */
function remax_store_homepage_hotoffer_section() {
	do_action( 'remax_store_homepage_hotoffer_section' );
}


/**
 * Homepage Products Tabs Section
 */
function remax_store_homepage_tabs_section() {
	do_action( 'remax_store_homepage_tabs_section' );
}

/**
 * Homepage Products Section Section
 */
function remax_store_homepage_product_section() {
	do_action( 'remax_store_homepage_product_section' );
}

/**
 * Homepage Blog Section
 */
function remax_store_homepage_blog_section() {
	do_action( 'remax_store_homepage_blog_section' );
}



/**
 * Homepage Blog Before main
 */
function remax_store_before_mainsec() {
	do_action( 'remax_store_before_mainsec' );
}


/**
 * Homepage Blog After main
 */
function remax_store_after_mainsec() {
	do_action( 'remax_store_after_mainsec' );
}