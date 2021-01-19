<?php
/**
 * Products Category Settings
 *
 ** @package Remax_Store
 */

function remax_store_customize_register_blog_section( $wp_customize ) {
    
    //Products Category
    $wp_customize->add_section( 'remax_store_blog_section', array(
        'title'    => esc_html__( 'Blog Section', 'remax-store' ),
        'priority' => 12,
        'panel'    =>'remax_store_homepage_setting'
    ) );
    

	//Blog Header Title
	$wp_customize->add_setting(
        'remax_store_blog_header_title',
        array(
            'default'           => esc_html__( 'LETEST NEWS', 'remax-store' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
		'remax_store_blog_header_title',
		array(
			'section'	  => 'remax_store_blog_section',
			'label'		  => esc_html__( 'Blog Header Title', 'remax-store' ),
            'type'        => 'text',
            'priority'    => 5,
		)		
    );
    //title refresh
    $wp_customize->selective_refresh->add_partial( 'remax_store_blog_header_title', array(
        'selector'          => '.letest-blog h5.uppercase.text-center',
        'render_callback'   => 'remax_store_blog_header_title_callback',
    ) );

    
	/** Select Blog Section Hear */
	$wp_customize->add_setting( 
        'remax_store_blog_category_id_select', 
        array(
			'default' => esc_html__( 'all', 'remax-store' ),
            'sanitize_callback' => 'remax_store_sanitize_select'
        )
    );
    
    $wp_customize->add_control( 
        'remax_store_blog_category_id_select', 
        array(
			'label'         => esc_html__( 'Select Post Category', 'remax-store' ),
			'description'   => esc_html__( 'Select the post category.', 'remax-store' ),
            'section'       => 'remax_store_blog_section',
            'type'          => 'select',
            'choices'       => remax_store_get_post_categories( ),
            'priority'      => 7,
        )
	); 
	

	//Number of Homepage Blog
	$wp_customize->add_setting(
        'remax_store_blog_number_of_post',
        array(
            'default'           => 3,
            'sanitize_callback' => 'absint',
        )
    );
    
    $wp_customize->add_control(
		'remax_store_blog_number_of_post',
		array(
			'section'	  => 'remax_store_blog_section',
			'label'		  => esc_html__( 'Number of Post', 'remax-store' ),
			'description' => esc_html__( 'Number of post display for display', 'remax-store' ),
            'type'        => 'number',
            'priority'      => 8,
		)		
    );


    
     /**
     * remax-store blog positions options
     */
    $wp_customize->add_setting(
		'remax_store_homepage_blog_section_sort', 
		array(
			'default' => array('remax_store_home_blog_thumbnail','remax_store_home_blog_category','remax_store_home_blog_title','remax_store_home_blog_meta'),
			'sanitize_callback' => 'remax_store_sanitize_sortable',						
		)
	);
	$wp_customize->add_control(
		new Remax_Store_Drag_Section_Control(
			$wp_customize,
			'remax_store_homepage_blog_section_sort',
			array(
				'section'     => 'remax_store_blog_section',
				'label'       => esc_html__( 'Blog Post Structure', 'remax-store' ),
				'choices'     => array(
					'remax_store_home_blog_thumbnail'       	=> esc_html__( 'Thumbnail', 'remax-store' ),
            		'remax_store_home_blog_category'       	    => esc_html__( 'Category', 'remax-store' ),
            		'remax_store_home_blog_title' 		        => esc_html__( 'Title', 'remax-store' ),
					'remax_store_home_blog_meta' 		        => esc_html__( 'Meta', 'remax-store' ),
				),
			)
		)
    );

    
    
    

}
add_action( 'customize_register', 'remax_store_customize_register_blog_section' );