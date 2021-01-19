<?php
/**
 * Banner Two and Hot Offer Display
 *
 * @package     Remax_Store
 * @author      Remax_Store
 * @copyright   Copyright (c) 2018, Remax_Store
 * @link        http://themerelic.com
 * @since       Remax_Store 1.0.0
 * */

function remax_store_products_section_cont( $wp_customize ) {

    
    //Products Section
    $wp_customize->add_section( 'remax_store_products_section_layout', array(
        'title'    => esc_html__( 'Products Sections', 'remax-store' ),
        'priority' => 10,
        'panel'    =>'remax_store_homepage_setting'
    ) );
    

    /**
	 * Woocommerce Remax Store file
	 * 
	 * @since 1.0.0
	 */
    $wp_customize->add_setting( 
        new Remax_Store_Repeater_Setting( 
            $wp_customize, 
            'remax_store_homepage_products_tabs', 
            array(
                'default' => array(
                        array(
                            'section_title' => esc_html__('BEST SELLING PRODUCT', 'remax-store' ),
                            'products_woocat' =>  '',
                            'products_count'  => 	3,
                        ),
                    )
                ,
                'sanitize_callback' => array( 'Remax_Store_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
		new Remax_Store_Repeater_Control(
			$wp_customize,
			'remax_store_homepage_products_tabs',
			array(
                'section' => 'remax_store_products_section_layout',
                'priority'    => 4,				
				'label'	  => esc_html__( 'Products Section ', 'remax-store' ),
				'fields'  => array(
                    'section_title' => array(
                        'type'        => 'text',
                        'default'     => esc_html__('BEST SELLING PRODUCT', 'remax-store' ),
                        'label'       => esc_html__( 'Product Section Title', 'remax-store' ),
                    ),
                    'products_woocat' => array(
                        'type'        => 'select',
                        'label'       => esc_html__( 'Products Category', 'remax-store' ),
						'choices'	  => remax_store_get_products_categories(),
					),
                    'products_count' => array(
                        'type'        => 'text',
                        'default'     => '3',
                        'label'       => esc_html__( 'Products Count', 'remax-store' ),
                    ),
                    
                ),
                'row_label' => array(
                    'type' => 'field',
                    'value' => esc_html__( 'Products Section', 'remax-store' ),
                    'field' => 'slider'
                )                        
			)
		)
    );


}
add_action( 'customize_register', 'remax_store_products_section_cont' );