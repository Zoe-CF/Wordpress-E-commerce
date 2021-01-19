<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 */

// Add excerpt section
$wp_customize->add_section( 'shopall_single_post_section', array(
	'title'             => esc_html__( 'Single Post','shopall' ),
	'description'       => esc_html__( 'Options to change the single posts globally.', 'shopall' ),
	'panel'             => 'shopall_theme_options_panel',
) );

// Tourableve date meta setting and control.
$wp_customize->add_setting( 'shopall_theme_options[single_post_hide_date]', array(
	'default'           => $options['single_post_hide_date'],
	'sanitize_callback' => 'shopall_sanitize_switch_control',
) );

$wp_customize->add_control( new Shopall_Switch_Control( $wp_customize, 'shopall_theme_options[single_post_hide_date]', array(
	'label'             => esc_html__( 'Hide Date', 'shopall' ),
	'section'           => 'shopall_single_post_section',
	'on_off_label' 		=> shopall_hide_options(),
) ) );

// Tourableve author meta setting and control.
$wp_customize->add_setting( 'shopall_theme_options[single_post_hide_author]', array(
	'default'           => $options['single_post_hide_author'],
	'sanitize_callback' => 'shopall_sanitize_switch_control',
) );

$wp_customize->add_control( new Shopall_Switch_Control( $wp_customize, 'shopall_theme_options[single_post_hide_author]', array(
	'label'             => esc_html__( 'Hide Author', 'shopall' ),
	'section'           => 'shopall_single_post_section',
	'on_off_label' 		=> shopall_hide_options(),
) ) );

// Tourableve author category setting and control.
$wp_customize->add_setting( 'shopall_theme_options[single_post_hide_category]', array(
	'default'           => $options['single_post_hide_category'],
	'sanitize_callback' => 'shopall_sanitize_switch_control',
) );

$wp_customize->add_control( new Shopall_Switch_Control( $wp_customize, 'shopall_theme_options[single_post_hide_category]', array(
	'label'             => esc_html__( 'Hide Category', 'shopall' ),
	'section'           => 'shopall_single_post_section',
	'on_off_label' 		=> shopall_hide_options(),
) ) );

// Tourableve tag category setting and control.
$wp_customize->add_setting( 'shopall_theme_options[single_post_hide_tags]', array(
	'default'           => $options['single_post_hide_tags'],
	'sanitize_callback' => 'shopall_sanitize_switch_control',
) );

$wp_customize->add_control( new Shopall_Switch_Control( $wp_customize, 'shopall_theme_options[single_post_hide_tags]', array(
	'label'             => esc_html__( 'Hide Tag', 'shopall' ),
	'section'           => 'shopall_single_post_section',
	'on_off_label' 		=> shopall_hide_options(),
) ) );
