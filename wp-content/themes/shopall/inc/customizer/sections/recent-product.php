<?php
/**
 * recent_product Section options
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 */
if ( !class_exists('WooCommerce') ) {
	return;
}

// Add recent_product section
$wp_customize->add_section( 'shopall_recent_product_section', array(
	'title'             => esc_html__( 'Recent Product','shopall' ),
	'description'       => esc_html__( 'Recent Product Section options.', 'shopall' ),
	'panel'             => 'shopall_front_page_panel',
) );

// recent_product content enable control and setting
$wp_customize->add_setting( 'shopall_theme_options[recent_product_section_enable]', array(
	'default'			=> 	$options['recent_product_section_enable'],
	'sanitize_callback' => 'shopall_sanitize_switch_control',
) );

$wp_customize->add_control( new Shopall_Switch_Control( $wp_customize, 'shopall_theme_options[recent_product_section_enable]', array(
	'label'             => esc_html__( 'Recent product Section Enable', 'shopall' ),
	'section'           => 'shopall_recent_product_section',
	'on_off_label' 		=> shopall_switch_options(),
) ) );




// recent_product title setting and control
$wp_customize->add_setting( 'shopall_theme_options[recent_product_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['recent_product_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'shopall_theme_options[recent_product_title]', array(
	'label'           	=> esc_html__( 'Title', 'shopall' ),
	'section'        	=> 'shopall_recent_product_section',
	'active_callback' 	=> 'shopall_is_recent_product_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'shopall_theme_options[recent_product_title]', array(
		'selector'            => '#recent-products .section-header h2',
		'settings'            => 'shopall_theme_options[recent_product_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'shopall_recent_product_title_partial',
    ) );
}


$wp_customize->add_setting( 'shopall_theme_options[recent_product_count]', array(
	'default'          	=> $options['recent_product_count'],
	'sanitize_callback' => 'shopall_sanitize_number_range',
	'validate_callback' => 'shopall_validate_recent_product_count',
) );

$wp_customize->add_control( 'shopall_theme_options[recent_product_count]', array(
	'label'             => esc_html__( 'Number of Product', 'shopall' ),
	'description'       => esc_html__( 'Note: Min 1 & Max 12. Please input the valid number and save. Then refresh the page to see the change.', 'shopall' ),
	'section'           => 'shopall_recent_product_section',
	'active_callback'   => 'shopall_is_recent_product_section_enable',
	'type'				=> 'number',
	'input_attrs'		=> array(
		'min'	=> 1,
		'max'	=> 12,
		'style' => 'width: 100px;'
		),
) );


for( $i = 1 ; $i <= $options['recent_product_count'] ; $i++ ){

	$wp_customize->add_setting( 'shopall_theme_options[recent_product_content_page_' . $i . ']', array(
		'sanitize_callback' => 'shopall_sanitize_page',
	) );

	$wp_customize->add_control( new Shopall_Dropdown_Chooser( $wp_customize, 'shopall_theme_options[recent_product_content_page_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Product %d', 'shopall' ), $i ),
		'section'           => 'shopall_recent_product_section',
		'choices'			=> shopall_product_choices(),
		'active_callback' 	=> 'shopall_is_recent_product_section_enable',
	) ) );
}
