<?php
/**
 * Reset options
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 */

/**
* Reset section
*/
// Add reset enable section
$wp_customize->add_section( 'shopall_reset_section', array(
	'title'             => esc_html__('Reset all settings','shopall'),
	'description'       => esc_html__( 'Caution: All settings will be reset to default. Refresh the page after clicking Save & Publish.', 'shopall' ),
) );

// Add reset enable setting and control.
$wp_customize->add_setting( 'shopall_theme_options[reset_options]', array(
	'default'           => $options['reset_options'],
	'sanitize_callback' => 'shopall_sanitize_checkbox',
	'transport'			  => 'postMessage',
) );

$wp_customize->add_control( 'shopall_theme_options[reset_options]', array(
	'label'             => esc_html__( 'Check to reset all settings', 'shopall' ),
	'section'           => 'shopall_reset_section',
	'type'              => 'checkbox',
) );
