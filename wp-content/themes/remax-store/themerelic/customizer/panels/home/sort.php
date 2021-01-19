<?php
/**
 * Home Page Sort Settings
 *
 * @package Remax_Store
 */
function remax_store_homepage_short( $wp_customize ){
    
    /** Homepage Sort Section */   
    $wp_customize->add_section( 'remax_store_homepage_short', array(
        'title'    => esc_html__( 'Sort Homepage Section', 'remax-store' ),
        'priority' => 22,
        'panel'    => 'remax_store_homepage_setting',
    ) ); 
    
    /** Homepage Sort Settings*/
    $wp_customize->add_setting(
		'remax_store_home_page_sort', 
		array(
			'default' => remax_store_customizer_section(),
			'sanitize_callback' => 'remax_store_sanitize_sortable',						
		)
	);

    /** Homepage Sort Controls */
	$wp_customize->add_control(
		new Remax_Store_Drag_Section_Control(
			$wp_customize,
			'remax_store_home_page_sort',
			array(
				'section'     => 'remax_store_homepage_short',
				'label'       => esc_html__( 'Homepage Sort Sections', 'remax-store' ),
				'description' => esc_html__( 'Sort or toggle home page sections.', 'remax-store' ),
				'choices'     => remax_store_sort_content_activate()
			)
		)
	);
    
}
add_action( 'customize_register', 'remax_store_homepage_short' );


