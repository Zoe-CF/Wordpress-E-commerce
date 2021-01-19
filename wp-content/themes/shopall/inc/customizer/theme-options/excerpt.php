<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 */

// Add excerpt section
$wp_customize->add_section( 'shopall_excerpt_section', array(
	'title'             => esc_html__( 'Excerpt','shopall' ),
	'description'       => esc_html__( 'Excerpt section options.', 'shopall' ),
	'panel'             => 'shopall_theme_options_panel',
) );


// long Excerpt length setting and control.
$wp_customize->add_setting( 'shopall_theme_options[long_excerpt_length]', array(
	'sanitize_callback' => 'shopall_sanitize_number_range',
	'validate_callback' => 'shopall_validate_long_excerpt',
	'default'			=> $options['long_excerpt_length'],
) );

$wp_customize->add_control( 'shopall_theme_options[long_excerpt_length]', array(
	'label'       		=> esc_html__( 'Blog Page Excerpt Length', 'shopall' ),
	'description' 		=> esc_html__( 'Total words to be displayed in archive page/search page.', 'shopall' ),
	'section'     		=> 'shopall_excerpt_section',
	'type'        		=> 'number',
	'input_attrs' 		=> array(
		'style'       => 'width: 80px;',
		'max'         => 100,
		'min'         => 5,
	),
) );
