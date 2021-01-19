<?php
/**
 * Breadcrumb options
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 */

$wp_customize->add_section( 'shopall_breadcrumb', array(
	'title'             => esc_html__( 'Breadcrumb','shopall' ),
	'description'       => esc_html__( 'Breadcrumb section options.', 'shopall' ),
	'panel'             => 'shopall_theme_options_panel',
) );

// Breadcrumb enable setting and control.
$wp_customize->add_setting( 'shopall_theme_options[breadcrumb_enable]', array(
	'sanitize_callback' => 'shopall_sanitize_switch_control',
	'default'          	=> $options['breadcrumb_enable'],
) );

$wp_customize->add_control( new Shopall_Switch_Control( $wp_customize, 'shopall_theme_options[breadcrumb_enable]', array(
	'label'            	=> esc_html__( 'Enable Breadcrumb', 'shopall' ),
	'section'          	=> 'shopall_breadcrumb',
	'on_off_label' 		=> shopall_switch_options(),
) ) );

// Breadcrumb separator setting and control.
$wp_customize->add_setting( 'shopall_theme_options[breadcrumb_separator]', array(
	'sanitize_callback'	=> 'sanitize_text_field',
	'default'          	=> $options['breadcrumb_separator'],
) );

$wp_customize->add_control( 'shopall_theme_options[breadcrumb_separator]', array(
	'label'            	=> esc_html__( 'Separator', 'shopall' ),
	'active_callback' 	=> 'shopall_is_breadcrumb_enable',
	'section'          	=> 'shopall_breadcrumb',
	'type'				=> 'text'
) );
