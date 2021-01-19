<?php
/**
 * Demo Import.
 *
 * This is the template that includes all the other files for core featured of Theme Palace
 *
 * @package Theme Palace
 * @subpackage shopall 
 * @since shopall  1.0.0
 */

function shopall_ctdi_plugin_page_setup( $default_settings ) {
    $default_settings['menu_title']  = esc_html__( 'Theme Palace Demo Import' , 'shopall' );

    return $default_settings;
}
add_filter( 'cp-ctdi/plugin_page_setup', 'shopall_ctdi_plugin_page_setup' );


function shopall_ctdi_plugin_intro_text( $default_text ) {
    $default_text .= sprintf( '<p class="about-description">%1$s <a href="%2$s">%3$s</a></p>', esc_html__( 'Demo content files for shopall  Theme.', 'shopall' ),
    esc_url( 'https://themepalace.com/download/shopall' ), esc_html__( 'Click here for Demo File download', 'shopall' ) );
    return $default_text;
}
add_filter( 'cp-ctdi/plugin_intro_text', 'shopall_ctdi_plugin_intro_text' );