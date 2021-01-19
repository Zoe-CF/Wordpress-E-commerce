<?php
/**
 * Woocommerce Settings
 *
 * @package Remax_Store
 */
function remax_store_customize_woocommerce_single_settings( $wp_customize ) {

    
    /**
     * Woocommerce Single Page Settings
     */
    $wp_customize->add_section( 'remax_store_woocommerce_single_page_sections', array(
        'title'    => esc_html__( 'Single Page Settings', 'remax-store' ),
        'priority' => 1,
        'panel'    => 'remax_store_woocommerce'
    ) );

    //Woocommerce Social Share in Single page
    $wp_customize->add_setting(
        'remax_store_social_share_enable',
        array(
            'default'           => true,
            'sanitize_callback' => 'remax_store_sanitize_checkbox'
        )
    );
    $wp_customize->add_control(
		new Remax_Store_Toggle_Control( 
			$wp_customize,
			'remax_store_social_share_enable',
			array(
				'section'	  => 'remax_store_woocommerce_single_page_sections',
				'label'		  => esc_html__( 'Disable Products Social Share', 'remax-store' ),
                'description' => esc_html__( 'Enable/Disable Social Share.', 'remax-store' ),
                'priority'    => 1
			)
		)
    );
    

    //Woocommerce Shop Page Settings
    $wp_customize->add_setting(
        'remax_store_woocommerce_related_products_posts_per_page',
        array(
            'default'           => 3,
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
		'remax_store_woocommerce_related_products_posts_per_page',
		array(
			'section'	  => 'remax_store_woocommerce_single_page_sections',
			'label'		  => esc_html__( 'Number of related products', 'remax-store' ),
			'description' => esc_html__( 'Number of related products', 'remax-store' ),
            'type'        => 'number',
            'priority'    => 3
		)		
    );

    //Woocommerce Shop page Settings
    $wp_customize->add_setting(
        'remax_store_woocommerce_related_products_columns',
        array(
            'default'           => 3,
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
		'remax_store_woocommerce_related_products_columns',
		array(
			'section'	  => 'remax_store_woocommerce_single_page_sections',
			'label'		  => esc_html__( 'Related Products Columns', 'remax-store' ),
			'description' => esc_html__( 'Number of related products columns.', 'remax-store' ),
            'type'        => 'number',
            'priority'    => 4
		)		
    );

    
        

}
add_action( 'customize_register', 'remax_store_customize_woocommerce_single_settings' );