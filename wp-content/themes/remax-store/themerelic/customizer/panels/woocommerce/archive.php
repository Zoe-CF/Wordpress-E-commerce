<?php
/**
 * Woocommerce Settings
 *
 * @package Remax_Store
 */
function remax_store_customize_woocommerce_woocommerce_settings( $wp_customize ) {

        /**
         * Woocommerce Settings
         */
        $wp_customize->add_section( 'remax_store_remax_store_page_sections', array(
            'title'    => esc_html__( 'Shop & Archive Page', 'remax-store' ),
            'priority' => 2,
            'panel'    => 'remax_store_woocommerce'
        ) );

        /**
         * Woocommerce Shop Page Settings
         */
        $wp_customize->add_setting(
            'remax_store_woocommerce_products_per_page',
            array(
                'default'           => 12,
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control(
            'remax_store_woocommerce_products_per_page',
            array(
                'section'	  => 'remax_store_remax_store_page_sections',
                'label'		  => esc_html__( 'Number of products', 'remax-store' ),
                'description' => esc_html__( 'Number of products in shop page.', 'remax-store' ),
                'type'        => 'number',
                'priority'    => 1
            )		
        );

        
        /**
         * Woocommerce Shop Sidebar Layout
         */
        $wp_customize->add_setting( 
            'remax_store_woocommerce_loop_columns', 
            array(
                'sanitize_callback' => 'remax_store_sanitize_select',
                'default'           => '3',
            )
        );
        $wp_customize->add_control( 
            'remax_store_woocommerce_loop_columns', 
            array(
                'label' => esc_html__( 'Products Columns', 'remax-store' ),
                'section' => 'remax_store_remax_store_page_sections',
                'type' => 'select',
                'choices' => array(
                                '1'         => esc_html__( '1 column', 'remax-store' ),
                                '2'         => esc_html__( '2 columns', 'remax-store' ),
                                '3'         => esc_html__( '3 columns', 'remax-store' ),
                                '4'         => esc_html__( '4 columns', 'remax-store' ),
                ),
                'priority'          => 2,
            )
        );


}
add_action( 'customize_register', 'remax_store_customize_woocommerce_woocommerce_settings' );