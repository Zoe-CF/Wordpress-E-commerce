<?php
/**
 * Home page Panel Settings
 *
 * @package Remax_Store
 */

function remax_store_customize_register_footer( $wp_customize ) {

    //Main Heaer Panel 
    $wp_customize->add_section( 'remax_store_footer_general_settings', array(
        'title'    => esc_html__( 'Footer Social Settings', 'remax-store' ),
        'priority' => 3,
    ) );
    
}
add_action( 'customize_register', 'remax_store_customize_register_footer' );