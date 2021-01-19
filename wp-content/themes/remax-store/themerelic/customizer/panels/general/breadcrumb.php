<?php
/**
 * Breadcrumb Settings
 *
 * @package Remax_Store
 */
function remax_store_customize_breadcrumb_settings( $wp_customize ) {

    //Breadcrumb Panel
    $wp_customize->add_section( 'remax_store_breadcrumb_sections', array(
        'title'    => esc_html__( 'Breadcrumb Settings', 'remax-store' ),
        'priority' => 81,
        'panel'    =>'general_setting'
    ) );

    //Breadcrumb Enable
    $wp_customize->add_setting(
        'remax_store_breadcrumb_enable',
        array(
            'default'           => true,
            'sanitize_callback' => 'remax_store_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
		new Remax_Store_Toggle_Control( 
			$wp_customize,
			'remax_store_breadcrumb_enable',
			array(
				'section'	  => 'remax_store_breadcrumb_sections',
				'label'		  => esc_html__( 'Disable Breadcrumb', 'remax-store' ),
                'description' => esc_html__( 'Enable/Disable Breadcrumb Sections.', 'remax-store' ),
                'priority'    => 1
			)
		)
    );

}
add_action( 'customize_register', 'remax_store_customize_breadcrumb_settings' );