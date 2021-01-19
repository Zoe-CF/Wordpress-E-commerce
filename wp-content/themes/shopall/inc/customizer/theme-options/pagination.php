<?php
/**
 * pagination options
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'shopall_pagination', array(
	'title'               => esc_html__('Pagination','shopall'),
	'description'         => esc_html__( 'Pagination section options.', 'shopall' ),
	'panel'               => 'shopall_theme_options_panel',
) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'shopall_theme_options[pagination_enable]', array(
	'sanitize_callback' => 'shopall_sanitize_switch_control',
	'default'             => $options['pagination_enable'],
) );

$wp_customize->add_control( new Shopall_Switch_Control( $wp_customize, 'shopall_theme_options[pagination_enable]', array(
	'label'               => esc_html__( 'Pagination Enable', 'shopall' ),
	'section'             => 'shopall_pagination',
	'on_off_label' 		=> shopall_switch_options(),
) ) );

// Site layout setting and control.
$wp_customize->add_setting( 'shopall_theme_options[pagination_type]', array(
	'sanitize_callback'   => 'shopall_sanitize_select',
	'default'             => $options['pagination_type'],
) );

$wp_customize->add_control( 'shopall_theme_options[pagination_type]', array(
	'label'               => esc_html__( 'Pagination Type', 'shopall' ),
	'section'             => 'shopall_pagination',
	'type'                => 'select',
	'choices'			  => shopall_pagination_options(),
	'active_callback'	  => 'shopall_is_pagination_enable',
) );
