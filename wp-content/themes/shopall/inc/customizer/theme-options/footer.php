<?php
/**
 * Footer options
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 */

// Footer Section
$wp_customize->add_section( 'shopall_section_footer',
	array(
		'title'      			=> esc_html__( 'Footer Options', 'shopall' ),
		'priority'   			=> 900,
		'panel'      			=> 'shopall_theme_options_panel',
	)
);

// footer text
$wp_customize->add_setting( 'shopall_theme_options[copyright_text]',
	array(
		'default'       		=> $options['copyright_text'],
		'sanitize_callback'		=> 'shopall_santize_allow_tag',
		'transport'				=> 'postMessage',
	)
);
$wp_customize->add_control( 'shopall_theme_options[copyright_text]',
    array(
		'label'      			=> esc_html__( 'Copyright Text', 'shopall' ),
		'section'    			=> 'shopall_section_footer',
		'type'		 			=> 'textarea',
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'shopall_theme_options[copyright_text]', array(
		'selector'            => '.site-info .wrapper span',
		'settings'            => 'shopall_theme_options[copyright_text]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'shopall_copyright_text_partial',
    ) );
}

// scroll top visible
$wp_customize->add_setting( 'shopall_theme_options[scroll_top_visible]',
	array(
		'default'       		=> $options['scroll_top_visible'],
		'sanitize_callback' => 'shopall_sanitize_switch_control',
	)
);
$wp_customize->add_control( new Shopall_Switch_Control( $wp_customize, 'shopall_theme_options[scroll_top_visible]',
    array(
		'label'      			=> esc_html__( 'Display Scroll Top Button', 'shopall' ),
		'section'    			=> 'shopall_section_footer',
		'on_off_label' 		=> shopall_switch_options(),
    )
) );

$wp_customize->add_setting( 'shopall_theme_options[footer_social_enable]', array(
	'default'			=> 	$options['footer_social_enable'],
	'sanitize_callback' => 'shopall_sanitize_switch_control',
) );

$wp_customize->add_control( new Shopall_Switch_Control( $wp_customize, 'shopall_theme_options[footer_social_enable]', array(
	'label'             => esc_html__( 'Social Menu Enable', 'shopall' ),
	'section'           => 'shopall_section_footer',
	'on_off_label' 		=> shopall_switch_options(),
) ) );

