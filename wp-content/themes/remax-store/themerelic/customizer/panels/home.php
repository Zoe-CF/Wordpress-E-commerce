<?php
/**
 * Home page Panel Settings
 *
 * @package Remax_Store
 */

function remax_store_customize_register_homepage( $wp_customize ) {
    
    $wp_customize->add_panel( 'remax_store_homepage_setting', array(
        'title'      => esc_html__( 'Front Page Settings', 'remax-store' ),
        'priority'   => 2
    ) );
        
}
add_action( 'customize_register', 'remax_store_customize_register_homepage' );