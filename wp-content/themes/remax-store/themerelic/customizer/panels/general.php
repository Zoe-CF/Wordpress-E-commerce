<?php
/**
 * General  Settings
 *
 * @package Remax_Store
 */

function remax_store_customize_register_general( $wp_customize ) {
    
    $wp_customize->add_panel( 'general_setting', array(
        'title'      => esc_html__( 'General Settings', 'remax-store' ),
        'priority'   => 1
    ) );
        
}
add_action( 'customize_register', 'remax_store_customize_register_general' );