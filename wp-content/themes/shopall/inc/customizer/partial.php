<?php
/**
* Partial functions
*
* @package Theme Palace
* @subpackage shopall
* @since shopall 1.0.0
*/


// Service Section
if ( ! function_exists( 'shopall_topbar_title_partial' ) ) :
    // popular destination title
    function shopall_topbar_title_partial() {
        $options = shopall_get_theme_options();
        return esc_html( $options['topbar_title'] );
    }
endif;




if ( ! function_exists( 'shopall_recent_product_title_partial' ) ) :
    // popular destination title
    function shopall_recent_product_title_partial() {
        $options = shopall_get_theme_options();
        return esc_html( $options['recent_product_title'] );
    }
endif;

if ( ! function_exists( 'shopall_recent_product_sub_title_partial' ) ) :
    // popular destination title
    function shopall_recent_product_sub_title_partial() {
        $options = shopall_get_theme_options();
        return esc_html( $options['recent_product_sub_title'] );
    }
endif;

if ( ! function_exists( 'shopall_blog_title_partial' ) ) :
    // popular destination title
    function shopall_blog_title_partial() {
        $options = shopall_get_theme_options();
        return esc_html( $options['blog_title'] );
    }
endif;

if ( ! function_exists( 'shopall_blog_sub_title_partial' ) ) :
    // popular destination title
    function shopall_blog_sub_title_partial() {
        $options = shopall_get_theme_options();
        return esc_html( $options['blog_sub_title'] );
    }
endif;


if ( ! function_exists( 'shopall_footer_banner_title_partial' ) ) :
    // popular destination title
    function shopall_footer_banner_title_partial() {
        $options = shopall_get_theme_options();
        return esc_html( $options['footer_banner_title'] );
    }
endif;

if ( ! function_exists( 'shopall_footer_banner_sub_title_partial' ) ) :
    // popular destination title
    function shopall_footer_banner_sub_title_partial() {
        $options = shopall_get_theme_options();
        return esc_html( $options['footer_banner_sub_title'] );
    }
endif;

if ( ! function_exists( 'shopall_copyright_text_partial' ) ) :
    // popular destination title
    function shopall_copyright_text_partial() {
        $options = shopall_get_theme_options();
        return esc_html( $options['copyright_text'] );
    }
endif;




