<?php
/**
* Homepage (Static ) options
*
* @package Theme Palace
* @subpackage shopall
* @since shopall 1.0.0
*/

// Homepage (Static ) setting and control.
$wp_customize->add_setting( 'shopall_theme_options[enable_frontpage_content]', array(
	'sanitize_callback'   => 'shopall_sanitize_checkbox',
	'default'             => $options['enable_frontpage_content'],
) );

$wp_customize->add_control( 'shopall_theme_options[enable_frontpage_content]', array(
	'label'       	=> esc_html__( 'Enable Content', 'shopall' ),
	'description' 	=> esc_html__( 'Check to enable content on static front page only.', 'shopall' ),
	'section'     	=> 'static_front_page',
	'type'        	=> 'checkbox',
	'active_callback' => 'shopall_is_static_homepage_enable',
) );