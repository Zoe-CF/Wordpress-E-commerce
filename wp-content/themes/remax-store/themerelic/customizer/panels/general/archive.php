<?php
/**
 * Archive page Settings
 *
 * @package Remax_Store
 */
function remax_store_customize_archive_page_settings( $wp_customize ) {

    //Main Heaer Panel 
    $wp_customize->add_section( 'remax_store_archive_page_settings', array(
        'title'    => esc_html__( 'Archive & Blog Page', 'remax-store' ),
        'priority' => 82,
        'panel'    =>'general_setting'
    ) );

    /**
     * Archive Post Excerpt Word Limit
     */
    $wp_customize->add_setting(
        'remax_store_the_excerpt_word_limit',
        array(
            'default'           => 20,
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
		'remax_store_the_excerpt_word_limit',
		array(
			'section'	  => 'remax_store_archive_page_settings',
			'label'		  => esc_html__( 'Excerpt limit(word)', 'remax-store' ),
			'description' => esc_html__( 'Number of excerpt limit word.', 'remax-store' ),
            'type'        => 'number',
            'priority'    => 2
		)		
    );


}
add_action( 'customize_register', 'remax_store_customize_archive_page_settings' );