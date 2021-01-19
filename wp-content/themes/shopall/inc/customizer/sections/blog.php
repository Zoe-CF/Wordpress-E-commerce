<?php
/**
 * Blog Section options
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 */

// Add Blog section
$wp_customize->add_section( 'shopall_blog_section', array(
	'title'             => esc_html__( 'Blog','shopall' ),
	'description'       => esc_html__( 'Blog Section options.', 'shopall' ),
	'panel'             => 'shopall_front_page_panel',
) );

// Blog content enable control and setting
$wp_customize->add_setting( 'shopall_theme_options[blog_section_enable]', array(
	'default'			=> 	$options['blog_section_enable'],
	'sanitize_callback' => 'shopall_sanitize_switch_control',
) );

$wp_customize->add_control( new Shopall_Switch_Control( $wp_customize, 'shopall_theme_options[blog_section_enable]', array(
	'label'             => esc_html__( 'Blog Section Enable', 'shopall' ),
	'section'           => 'shopall_blog_section',
	'on_off_label' 		=> shopall_switch_options(),
) ) );




// blog title setting and control
$wp_customize->add_setting( 'shopall_theme_options[blog_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['blog_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'shopall_theme_options[blog_title]', array(
	'label'           	=> esc_html__( 'Title', 'shopall' ),
	'section'        	=> 'shopall_blog_section',
	'active_callback' 	=> 'shopall_is_blog_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'shopall_theme_options[blog_title]', array(
		'selector'            => '#latest-posts .section-header h2',
		'settings'            => 'shopall_theme_options[blog_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'shopall_blog_title_partial',
    ) );
}

$wp_customize->add_setting( 'shopall_theme_options[blog_count]', array(
	'default'          	=> $options['blog_count'],
	'sanitize_callback' => 'shopall_sanitize_number_range',
) );

$wp_customize->add_control( 'shopall_theme_options[blog_count]', array(
	'label'             => esc_html__( 'Number of Post', 'shopall' ),
	'description'       => esc_html__( 'Note: Min 3 & Max 12. Please input the valid number and save. Then refresh the page to see the change.', 'shopall' ),
	'section'           => 'shopall_blog_section',
	'active_callback'   => 'shopall_is_blog_section_enable',
	'type'				=> 'number',
	'input_attrs'		=> array(
		'min'	=> 3,
		'max'	=> 12,
		'style' => 'width: 100px;'
		),
) );

// Blog content type control and setting
$wp_customize->add_setting( 'shopall_theme_options[blog_content_type]', array(
	'default'          	=> $options['blog_content_type'],
	'sanitize_callback' => 'shopall_sanitize_select',
) );

$wp_customize->add_control( 'shopall_theme_options[blog_content_type]', array(
	'label'             => esc_html__( 'Content Type', 'shopall' ),
	'section'           => 'shopall_blog_section',
	'type'				=> 'select',
	'active_callback' 	=> 'shopall_is_blog_section_enable',
	'choices'			=> array( 
		'post' 		=> esc_html__( 'Post', 'shopall' ),
		'recent' 	=> esc_html__( 'Recent', 'shopall' ),
	),
) );



for ( $i = 1; $i <= $options['blog_count']; $i++ ) :
	// blog posts drop down chooser control and setting
	$wp_customize->add_setting( 'shopall_theme_options[blog_content_post_' . $i . ']', array(
		'sanitize_callback' => 'shopall_sanitize_page',
	) );

	$wp_customize->add_control( new Shopall_Dropdown_Chooser( $wp_customize, 'shopall_theme_options[blog_content_post_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Post %d', 'shopall' ), $i ),
		'section'           => 'shopall_blog_section',
		'choices'			=> shopall_post_choices(),
		'active_callback'	=> 'shopall_is_blog_section_content_post_enable',
	) ) );
endfor;

