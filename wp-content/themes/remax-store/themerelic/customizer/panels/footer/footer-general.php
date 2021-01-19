<?php
/**
 * Archive page Settings
 *
 * @package Remax_Store 
 * Use: Footer General Settings hear
 */
function remax_store_customize_footer_general_settings( $wp_customize ) {

    /**
     * Toggle soical medai section.
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'remax_store_menu_social_media_enable',
        array(
            'default'           => false,
            'sanitize_callback' => 'remax_store_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
		new Remax_Store_Toggle_Control( 
			$wp_customize,
			'remax_store_menu_social_media_enable',
			array(
				'section'	  => 'remax_store_footer_general_settings',
				'label'		  => esc_html__( 'Disable Menu Social Media', 'remax-store' ),
                'priority'    => 1
			)
		)
    );

     /**
     * Toggle soical medai section.
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'remax_store_menu_footer_social_media_enable',
        array(
            'default'           => false,
            'sanitize_callback' => 'remax_store_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
		new Remax_Store_Toggle_Control( 
			$wp_customize,
			'remax_store_menu_footer_social_media_enable',
			array(
				'section'	  => 'remax_store_footer_general_settings',
				'label'		  => esc_html__( 'Disable Footer Social Media', 'remax-store' ),
                'priority'    => 1
			)
		)
    );

    //facebook url
    $wp_customize->add_setting( 
        'remax_store_social_facebook_url', 
        array(
            'default'           => esc_html__('https://facebook.com/','remax-store'),
            'sanitize_callback' => 'esc_url_raw' //cleans URL from all invalid characters
        )
    );
    $wp_customize->add_control( 
        'remax_store_social_facebook_url', 
        array(
            'label' => esc_html__( 'Facebook URL', 'remax-store' ),
            'section' => 'remax_store_footer_general_settings',
            'type' => 'url'
        )
    );  
    
    //twitter url
    $wp_customize->add_setting( 
        'remax_store_social_twitter_url', 
        array(
            'default'           => esc_html__('https://twitter.com/', 'remax-store' ),
            'sanitize_callback' => 'esc_url_raw', //cleans URL from all invalid characters
            
        )
    );
    $wp_customize->add_control( 
        'remax_store_social_twitter_url', 
        array(
            'label' => esc_html__( 'Twitter URL', 'remax-store' ),
            'section' => 'remax_store_footer_general_settings',
            'type' => 'url'
        )
    );  


    //youtube url
    $wp_customize->add_setting( 
        'remax_store_social_youtube_url', 
        array(
            'default'           => esc_html__('https://youtube.com/', 'remax-store' ),
            'sanitize_callback' => 'esc_url_raw', //cleans URL from all invalid characters
            
        )
    );
    $wp_customize->add_control( 
        'remax_store_social_youtube_url', 
        array(
            'label' => esc_html__( 'Youtube URL', 'remax-store' ),
            'section' => 'remax_store_footer_general_settings',
            'type' => 'url'
        )
    );

   

    //instagram url
    $wp_customize->add_setting( 
        'remax_store_social_instagram_url', 
        array(
            'default'           => esc_html__('https://instagram.com/', 'remax-store' ),
            'sanitize_callback' => 'esc_url_raw', //cleans URL from all invalid characters
            
        )
    );
    $wp_customize->add_control( 
        'remax_store_social_instagram_url', 
        array(
            'label' => esc_html__( 'Instagram URL', 'remax-store' ),
            'section' => 'remax_store_footer_general_settings',
            'type' => 'url'
        )
    );

    //plus_goolge url
    $wp_customize->add_setting( 
        'remax_store_social_plus_goolge_url', 
        array(
            'default'           => esc_html__('https://plus.google.com', 'remax-store' ),
            'sanitize_callback' => 'esc_url_raw', //cleans URL from all invalid characters
            
        )
    );
    $wp_customize->add_control( 
        'remax_store_social_plus_goolge_url', 
        array(
            'label' => esc_html__( 'Google Plus URL', 'remax-store' ),
            'section' => 'remax_store_footer_general_settings',
            'type' => 'url'
        )
    );
    
}
add_action( 'customize_register', 'remax_store_customize_footer_general_settings' );