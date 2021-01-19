<?php
/**
 * Slider Section options
 *
 * @package Theme Palace
 * @subpackage Shopall Pro
 * @since Shopall Pro 1.0.0
 */

// Add Slider section
$wp_customize->add_section( 'shopall_slider_section', array(
	'title'             => esc_html__( 'Main Slider','shopall' ),
	'description'       => esc_html__( 'Slider Section options.', 'shopall' ),
	'panel'             => 'shopall_front_page_panel',
) );

// Slider content enable control and setting
$wp_customize->add_setting( 'shopall_theme_options[slider_section_enable]', array(
	'default'			=> 	$options['slider_section_enable'],
	'sanitize_callback' => 'shopall_sanitize_switch_control',
) );

$wp_customize->add_control( new Shopall_Switch_Control( $wp_customize, 'shopall_theme_options[slider_section_enable]', array(
	'label'             => esc_html__( 'Slider Section Enable', 'shopall' ),
	'section'           => 'shopall_slider_section',
	'on_off_label' 		=> shopall_switch_options(),
) ) );

// Slider content enable control and setting
$wp_customize->add_setting( 'shopall_theme_options[slider_autoplay]', array(
	'default'			=> 	$options['slider_autoplay'],
	'sanitize_callback' => 'shopall_sanitize_switch_control',
) );

$wp_customize->add_control( new Shopall_Switch_Control( $wp_customize, 'shopall_theme_options[slider_autoplay]', array(
	'label'             => esc_html__( 'Auto Play Enable', 'shopall' ),
	'section'           => 'shopall_slider_section',
	'on_off_label' 		=> shopall_switch_options(),
	'active_callback' 	=> 'shopall_is_slider_section_enable',
) ) );

$wp_customize->add_setting( 'shopall_theme_options[slider_sub_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['slider_sub_title'],
) );

$wp_customize->add_control( 'shopall_theme_options[slider_sub_title]', array(
	'label'           	=> esc_html__( 'Slider Sub Title ', 'shopall' ),
	'section'        	=> 'shopall_slider_section',
	'active_callback' 	=> 'shopall_is_slider_section_enable',
	'type'				=> 'text',
) );

$wp_customize->add_setting( 'shopall_theme_options[slider_offer_label]', array(
	'sanitize_callback' => 'wp_kses_post',
	'default'			=> $options['slider_offer_label'],
) );

$wp_customize->add_control( 'shopall_theme_options[slider_offer_label]', array(
	'label'           	=> esc_html__( 'Slider Offer Label', 'shopall' ),
	'section'        	=> 'shopall_slider_section',
	'active_callback' 	=> 'shopall_is_slider_section_enable',
	'type'				=> 'text',
) );


$wp_customize->add_setting( 'shopall_theme_options[slider_btn_label]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['slider_btn_label'],
) );

$wp_customize->add_control( 'shopall_theme_options[slider_btn_label]', array(
	'label'           	=> esc_html__( 'Slider Button Lable ', 'shopall' ),
	'section'        	=> 'shopall_slider_section',
	'active_callback' 	=> 'shopall_is_slider_section_enable',
	'type'				=> 'text',
) );





for ( $i = 1; $i <= 3; $i++ ) :
	// slider pages drop down chooser control and setting
	$wp_customize->add_setting( 'shopall_theme_options[slider_content_page_' . $i . ']', array(
		'sanitize_callback' => 'shopall_sanitize_page',
	) );

	$wp_customize->add_control( new Shopall_Dropdown_Chooser( $wp_customize, 'shopall_theme_options[slider_content_page_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Page %d', 'shopall' ), $i ),
		'section'           => 'shopall_slider_section',
		'choices'			=> shopall_page_choices(),
		'active_callback' 	=> 'shopall_is_slider_section_enable',
	) ) );

endfor;

