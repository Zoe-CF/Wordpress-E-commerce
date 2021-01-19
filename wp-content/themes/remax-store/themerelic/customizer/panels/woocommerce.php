<?php
/**
 * Woocommerce  Settings
 *
 * @package Remax_Store
 */

function remax_store_customize_register_woocommerce( $wp_customize ) {
    
    $wp_customize->add_panel( 'remax_store_woocommerce', array(
        'title'      => esc_html__( 'Woocommerce', 'remax-store' ),
        'priority'   => 2
    ) );
        
}
add_action( 'customize_register', 'remax_store_customize_register_woocommerce' );