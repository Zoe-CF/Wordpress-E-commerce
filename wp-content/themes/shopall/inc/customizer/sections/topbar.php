<?php
/**
 * Topbar Section options
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 */

// Add Topbar section
$wp_customize->add_section( 'shopall_topbar_section', array(
	'title'             => esc_html__( 'Topbar','shopall' ),
	'description'       => esc_html__( 'Topbar Section options.', 'shopall' ),
	'panel'             => 'shopall_front_page_panel',
) );

// topbar enable/disable control and setting
$wp_customize->add_setting( 'shopall_theme_options[topbar_section_enable]', array(
	'default'			=> 	$options['topbar_section_enable'],
	'sanitize_callback' => 'shopall_sanitize_switch_control',
) );

$wp_customize->add_control( new Shopall_Switch_Control( $wp_customize, 'shopall_theme_options[topbar_section_enable]', array(
	'label'             => esc_html__( 'Topbar Section Enable', 'shopall' ),
	'section'           => 'shopall_topbar_section',
	'on_off_label' 		=> shopall_switch_options(),
) ) );



$wp_customize->add_setting( 'shopall_theme_options[topbar_title]', array(
    'default'           =>  $options['topbar_title'],
    'sanitize_callback' => 'wp_kses_post',
    'transport'			=> 'postMessage',
) );

$wp_customize->add_control('shopall_theme_options[topbar_title]', array(
    'label'             => esc_html__( 'Topbar Text', 'shopall' ),
    'section'           => 'shopall_topbar_section',
    'type'              => 'textarea',
    'active_callback'   => 'shopall_is_topbar_section_enable',
 ) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'shopall_theme_options[topbar_title]', array(
		'selector'            => '#top-bar .wrapper span',
		'settings'            => 'shopall_theme_options[topbar_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'shopall_topbar_title_partial',
    ) );
}






