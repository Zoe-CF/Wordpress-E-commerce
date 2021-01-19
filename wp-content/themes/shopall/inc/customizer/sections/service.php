<?php
/**
 * service Section options
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 */

// Add service section
$wp_customize->add_section( 'shopall_service_section', array(
	'title'             => esc_html__( 'Service','shopall' ),
	'description'       => esc_html__( 'Service Section options.', 'shopall' ),
	'panel'             => 'shopall_front_page_panel',
) );

// service content enable control and setting
$wp_customize->add_setting( 'shopall_theme_options[service_section_enable]', array(
	'default'			=> 	$options['service_section_enable'],
	'sanitize_callback' => 'shopall_sanitize_switch_control',
) );

$wp_customize->add_control( new Shopall_Switch_Control( $wp_customize, 'shopall_theme_options[service_section_enable]', array(
	'label'             => esc_html__( 'Service Section Enable', 'shopall' ),
	'section'           => 'shopall_service_section',
	'on_off_label' 		=> shopall_switch_options(),
) ) );


for ( $i = 1; $i <= 3; $i++ ) :
	// service pages drop down chooser control and setting
	$wp_customize->add_setting( 'shopall_theme_options[service_content_page_' . $i . ']', array(
		'sanitize_callback' => 'shopall_sanitize_page',
	) );

	$wp_customize->add_control( new Shopall_Dropdown_Chooser( $wp_customize, 'shopall_theme_options[service_content_page_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Page %d', 'shopall' ), $i ),
		'section'           => 'shopall_service_section',
		'choices'			=> shopall_page_choices(),
		'active_callback'   => 'shopall_is_service_section_enable',
	) ) );

	$wp_customize->add_setting( 'shopall_theme_options[service_content_icon_' . $i . ']', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

    $wp_customize->add_control( new Shopall_Icon_Picker( $wp_customize, 'shopall_theme_options[service_content_icon_' . $i . ']', array(
        'label'             => sprintf( esc_html__( 'Select Icon %d', 'shopall' ), $i ),
        'section'           => 'shopall_service_section',
        'active_callback'   => 'shopall_is_service_section_enable',
    ) ) );

    $wp_customize->add_setting( 'shopall_theme_options[service_hr_'. $i .']', array(
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new Shopall_Customize_Horizontal_Line( $wp_customize, 'shopall_theme_options[service_hr_'. $i .']',
        array(
            'section'           => 'shopall_service_section',
            'active_callback'   => 'shopall_is_service_section_enable',
            'type'            => 'hr'
    ) ) );
endfor;