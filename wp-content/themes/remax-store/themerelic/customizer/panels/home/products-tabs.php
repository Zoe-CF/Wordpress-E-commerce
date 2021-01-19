<?php
/**
 * Products Tabs  Settings
 *
 * @package Remax_Store
 */

function remax_store_customize_register_products_tab( $wp_customize ) {

    
    //Products Category
    $wp_customize->add_section( 'remax_store_products_tab_section', array(
        'title'    => esc_html__( 'Products Tabs', 'remax-store' ),
        'priority' => 6,
        'panel'    =>'remax_store_homepage_setting'
	) );

	
    /******************************************************************************
	 * 					Category Section Hear 
	 ***************************************************************************/
    $wp_customize->add_setting(
		'remax_store_products_tabs_multiple_cat', 
		array(
			'default' 			=> array(remax_store_get_default_products_categories()),
			'sanitize_callback' => 'remax_store_sanitize_multiple_check',				
		)
	);
	$wp_customize->add_control(
		new Remax_Store_MultiCheck_Control(
			$wp_customize,
			'remax_store_products_tabs_multiple_cat',
			array(
				'section'     => 'remax_store_products_tab_section',
				'label'       => esc_html__( 'Products Tab Category', 'remax-store' ),
                'description' => esc_html__( 'Select products tab section categories.', 'remax-store' ),
				'choices'     => remax_store_get_products_categories( )
			)
		)
	);

	//Products Category Number of Products
	$wp_customize->add_setting(
        'remax_store_products_tab_number_of_products',
        array(
            'default'           => 8,
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
		'remax_store_products_tab_number_of_products',
		array(
			'section'	  => 'remax_store_products_tab_section',
			'label'		  => esc_html__( 'Number of Products', 'remax-store' ),
			'description' => esc_html__( 'Number of products display on tab section.', 'remax-store' ),
            'type'        => 'number'
		)		
	);

	

}
add_action( 'customize_register', 'remax_store_customize_register_products_tab' );