<?php
/**
 * Banner Two and Products in Between Display
 *
 ** @package Remax_Store
 */

function remax_store_hot_offer_category( $wp_customize ) {

    
    //Banner Section
    $wp_customize->add_section( 'remax_store_hotoffer_section', array(
        'title'    => esc_html__( 'Hot Offer', 'remax-store' ),
        'priority' => 4,
        'panel'    =>'remax_store_homepage_setting'
	) );
    
    
    //Single Category Products
    $wp_customize->add_setting( 
        'remax_store_hotoffer_cat_id', 
        array(
            'sanitize_callback' => 'remax_store_sanitize_select'
        )
    );
    $wp_customize->add_control( 
        'remax_store_hotoffer_cat_id', 
        array(
            'label'     => esc_html__( 'Select Category', 'remax-store'  ),
            'section'   => 'remax_store_hotoffer_section',
            'type'      => 'select',
            'choices'   => remax_store_get_woocommerce_products_id(),
            'priority'  => 3
        )
    ); 

    //add the remax-store section
    $wp_customize->add_setting('remax_store_hotdeal_section_background_images', array(
        'default'           => esc_url( REMAX_STORE_THEME_IMG.'countdown.png' ),
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'remax_store_hotdeal_section_background_images', array(
        'label'             => esc_html__('Background Images', 'remax-store'),
        'section'           => 'remax_store_hotoffer_section',
        'settings'          => 'remax_store_hotdeal_section_background_images',
        'priority'          => 4
    )));


}
add_action( 'customize_register', 'remax_store_hot_offer_category' );