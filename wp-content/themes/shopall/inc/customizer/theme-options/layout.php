<?php
/**
 * Layout options
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'shopall_layout', array(
	'title'               => esc_html__('Layout','shopall'),
	'description'         => esc_html__( 'Layout section options.', 'shopall' ),
	'panel'               => 'shopall_theme_options_panel',
) );

// Site layout setting and control.
$wp_customize->add_setting( 'shopall_theme_options[site_layout]', array(
	'sanitize_callback'   => 'shopall_sanitize_select',
	'default'             => $options['site_layout'],
) );

$wp_customize->add_control(  new Shopall_Custom_Radio_Image_Control ( $wp_customize, 'shopall_theme_options[site_layout]', array(
	'label'               => esc_html__( 'Site Layout', 'shopall' ),
	'section'             => 'shopall_layout',
	'choices'			  => shopall_site_layout(),
) ) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'shopall_theme_options[sidebar_position]', array(
	'sanitize_callback'   => 'shopall_sanitize_select',
	'default'             => $options['sidebar_position'],
) );

$wp_customize->add_control(  new Shopall_Custom_Radio_Image_Control ( $wp_customize, 'shopall_theme_options[sidebar_position]', array(
	'label'               => esc_html__( 'Global Sidebar Position', 'shopall' ),
	'section'             => 'shopall_layout',
	'choices'			  => shopall_global_sidebar_position(),
) ) );

// Post sidebar position setting and control.
$wp_customize->add_setting( 'shopall_theme_options[post_sidebar_position]', array(
	'sanitize_callback'   => 'shopall_sanitize_select',
	'default'             => $options['post_sidebar_position'],
) );

$wp_customize->add_control(  new Shopall_Custom_Radio_Image_Control ( $wp_customize, 'shopall_theme_options[post_sidebar_position]', array(
	'label'               => esc_html__( 'Posts Sidebar Position', 'shopall' ),
	'section'             => 'shopall_layout',
	'choices'			  => shopall_sidebar_position(),
) ) );

// Post sidebar position setting and control.
$wp_customize->add_setting( 'shopall_theme_options[page_sidebar_position]', array(
	'sanitize_callback'   => 'shopall_sanitize_select',
	'default'             => $options['page_sidebar_position'],
) );

$wp_customize->add_control( new Shopall_Custom_Radio_Image_Control( $wp_customize, 'shopall_theme_options[page_sidebar_position]', array(
	'label'               => esc_html__( 'Pages Sidebar Position', 'shopall' ),
	'section'             => 'shopall_layout',
	'choices'			  => shopall_sidebar_position(),
) ) );