<?php
/**
 * General Settings Hear
 *
 * @package remax-store
 */

function remax_store_layout_settings( $wp_customize ) {
	
    //Products Category
    $wp_customize->add_section( 'remax_store_layout_section', array(
        'title'    => esc_html__( 'Sidebar Layout', 'remax-store' ),
        'priority' => 3,
        'panel'    =>'general_setting'
	) );

    //Enable  Slider
    $wp_customize->add_setting( 
        'remax_store_post_sidebar_layout_settings', 
        array(
            'sanitize_callback' => 'remax_store_sanitize_select',
            'default'           => esc_html__('remax-store-right-sidebar', 'remax-store' ),
        )
    );
    $wp_customize->add_control( 
        'remax_store_post_sidebar_layout_settings', 
        array(
            'label' => esc_html__( 'Post Sidebar Layout', 'remax-store' ),
            'section' => 'remax_store_layout_section',
            'type' => 'select',
            'choices' => array(
                            'remax-store-left-sidebar'      => esc_html__( 'Left Sidebar', 'remax-store' ),
                            'remax-store-right-sidebar'     => esc_html__( 'Right Sidebar', 'remax-store' ),
                            'remax-store-full-width'        => esc_html__( 'Full Width', 'remax-store' ),
            ),
            'priority'          => 3,
        )
    ); 

}
add_action( 'customize_register', 'remax_store_layout_settings' );