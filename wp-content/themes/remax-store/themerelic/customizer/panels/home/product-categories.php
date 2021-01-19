<?php
/**
 * Products Category Settings
 *
 * @package Remax_Store
 */

function remax_store_customize_register_product_category_section( $wp_customize ) {
    
    //Products Category
    $wp_customize->add_section( 'remax_store_products_category_section', array(
        'title'    => esc_html__( 'Products Category', 'remax-store' ),
        'priority' => 3,
        'panel'    =>'remax_store_homepage_setting'
	) );

    
    /** Category Section Hear */
    $wp_customize->add_setting(
		'remax_store_products_categorys_id', 
		array(
			'default' => remax_store_get_multiple_product_categories(),
			'sanitize_callback' => 'remax_store_sanitize_multiple_check' //						
		)
	);

	$wp_customize->add_control(
		new Remax_Store_MultiCheck_Control(
			$wp_customize,
			'remax_store_products_categorys_id',
			array(
				'section'     => 'remax_store_products_category_section',
				'label'       => esc_html__( 'Products Category', 'remax-store' ),
                'description' => esc_html__( 'Select products category section.', 'remax-store' ),
				'choices'     => remax_store_get_products_categories( )
			)
		)
	);

	

}
add_action( 'customize_register', 'remax_store_customize_register_product_category_section' );
