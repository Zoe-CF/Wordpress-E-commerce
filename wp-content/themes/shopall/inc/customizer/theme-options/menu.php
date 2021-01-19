<?php
/**
 * Menu options
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'shopall_menu', array(
	'title'             => esc_html__('Header Menu','shopall'),
	'description'       => esc_html__( 'Header Menu options.', 'shopall' ),
	'panel'             => 'nav_menus',
) );

// Menu sticky setting and control.
$wp_customize->add_setting( 'shopall_theme_options[menu_sticky]', array(
	'sanitize_callback' => 'shopall_sanitize_switch_control',
	'default'           => $options['menu_sticky'],
) );

$wp_customize->add_control( new Shopall_Switch_Control( $wp_customize, 'shopall_theme_options[menu_sticky]', array(
	'label'             => esc_html__( 'Make Menu Sticky', 'shopall' ),
	'section'           => 'shopall_menu',
	'on_off_label' 		=> shopall_switch_options(),
) ) );

// search enable setting and control.
$wp_customize->add_setting( 'shopall_theme_options[social_nav_enable]', array(
	'sanitize_callback' => 'shopall_sanitize_switch_control',
	'default'           => $options['social_nav_enable'],
) );

$wp_customize->add_control( new Shopall_Switch_Control( $wp_customize, 'shopall_theme_options[social_nav_enable]', array(
	'label'             => esc_html__( 'Enable Social Links', 'shopall' ),
	'description'       => sprintf( '%1$s <a class="topbar-menu-trigger" href="#"> %2$s </a> %3$s', esc_html__( 'Note: To show social menu.', 'shopall' ), esc_html__( 'Click Here', 'shopall' ), esc_html__( 'to create menu', 'shopall' ) ),
	'section'           => 'shopall_menu',
	'on_off_label' 		=> shopall_switch_options(),
) ) );

$wp_customize->add_setting( 'shopall_theme_options[register_link]', array(
	'sanitize_callback' => 'esc_url_raw',
	'default'           => '',
) );

$wp_customize->add_control( 'shopall_theme_options[register_link]', array(
	'label'             => esc_html__( 'Register Link', 'shopall' ),
	'section'           => 'shopall_menu',
	'type'				=> 'url'
 ) );

$wp_customize->add_setting( 'shopall_theme_options[sign_in_link]', array(
	'sanitize_callback' => 'esc_url_raw',
	'default'           => '',
) );

$wp_customize->add_control( 'shopall_theme_options[sign_in_link]', array(
	'label'             => esc_html__( 'Sign In Link', 'shopall' ),
	'section'           => 'shopall_menu',
	'type'				=> 'url'
) );