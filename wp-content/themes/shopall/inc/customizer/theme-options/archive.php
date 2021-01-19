<?php
/**
 * Archive options
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 */

// Add archive section
$wp_customize->add_section( 'shopall_archive_section', array(
	'title'             => esc_html__( 'Blog/Archive','shopall' ),
	'description'       => esc_html__( 'Archive section options.', 'shopall' ),
	'panel'             => 'shopall_theme_options_panel',
) );

// Your latest posts title setting and control.
$wp_customize->add_setting( 'shopall_theme_options[your_latest_posts_title]', array(
	'default'           => $options['your_latest_posts_title'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'shopall_theme_options[your_latest_posts_title]', array(
	'label'             => esc_html__( 'Your Latest Posts Title', 'shopall' ),
	'description'       => esc_html__( 'This option only works if Static Front Page is set to "Your latest posts."', 'shopall' ),
	'section'           => 'shopall_archive_section',
	'type'				=> 'text',
	'active_callback'   => 'shopall_is_latest_posts'
) );

// Archive date meta setting and control.
$wp_customize->add_setting( 'shopall_theme_options[hide_date]', array(
	'default'           => $options['hide_date'],
	'sanitize_callback' => 'shopall_sanitize_switch_control',
) );

$wp_customize->add_control( new Shopall_Switch_Control( $wp_customize, 'shopall_theme_options[hide_date]', array(
	'label'             => esc_html__( 'Hide Date', 'shopall' ),
	'section'           => 'shopall_archive_section',
	'on_off_label' 		=> shopall_hide_options(),
) ) );

// Archive category setting and control.
$wp_customize->add_setting( 'shopall_theme_options[hide_category]', array(
	'default'           => $options['hide_category'],
	'sanitize_callback' => 'shopall_sanitize_switch_control',
) );

$wp_customize->add_control( new Shopall_Switch_Control( $wp_customize, 'shopall_theme_options[hide_category]', array(
	'label'             => esc_html__( 'Hide Category', 'shopall' ),
	'section'           => 'shopall_archive_section',
	'on_off_label' 		=> shopall_hide_options(),
) ) );
