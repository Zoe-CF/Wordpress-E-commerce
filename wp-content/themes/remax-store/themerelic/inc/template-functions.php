<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package     Remax_Store
 * @author      Themerelic
 * @copyright   Copyright (c) 2018, Themerelic
 * @link        http://themerelic.com
 * @since       Remax_Store 1.0.0
 * */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function remax_store_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}


	/**
	 * Remax_Store Sidebar functions
	 * 
	 * @since 1.0.0
	*/
	$remax_store_sidebar_layout = get_theme_mod( 'remax_store_post_sidebar_layout_settings','remax-store-right-sidebar' );
	if(remax_store_is_woocommerce_activated()){
		if( !is_woocommerce() ){
			$classes[] = $remax_store_sidebar_layout;
		}	
	}else{
		$classes[] = $remax_store_sidebar_layout;
	}
	

	return $classes;
}
add_filter( 'body_class', 'remax_store_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function remax_store_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'remax_store_pingback_header' );
