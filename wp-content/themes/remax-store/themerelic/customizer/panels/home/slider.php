<?php
/**
 * Slider Settings
 *
 * @package Remax_Store
 */
function remax_store_customize_register_slider( $wp_customize ) {
    
    
    
    //Slider Section 
    $wp_customize->add_section( 'remax_store_homepage_slider', array(
        'title'    => esc_html__( 'Slider Settings', 'remax-store' ),
        'priority' => 1,
        'panel'    =>'remax_store_homepage_setting'
    ) );

    /** Select Blog Section Hear */
	$wp_customize->add_setting( 
        'remax_store_slider_category_id', 
        array(
			'default' => esc_html__( 'all', 'remax-store' ),
            'sanitize_callback' => 'remax_store_sanitize_select'
        )
    );
    
    $wp_customize->add_control( 
        'remax_store_slider_category_id', 
        array(
			'label'         => esc_html__( 'Frontpage Slider Category', 'remax-store' ),
			'description'   => esc_html__( 'Select the post category.', 'remax-store' ),
            'section'       => 'remax_store_blog_section',
            'type'          => 'select',
            'choices'       => remax_store_get_post_categories( ),
            'priority'      => 7,
        )
	); 
	

	//Number of Homepage Blog
	$wp_customize->add_setting(
        'remax_store_slider_number_of_post',
        array(
            'default'           => 3,
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
		'remax_store_slider_number_of_post',
		array(
			'section'	  => 'remax_store_blog_section',
			'label'		  => esc_html__( 'Number of slider', 'remax-store' ),
			'description' => esc_html__( 'Number of slider display for display', 'remax-store' ),
            'type'        => 'number',
            'priority'      => 2,
		)		
    );

}
add_action( 'customize_register', 'remax_store_customize_register_slider' );