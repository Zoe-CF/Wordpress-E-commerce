<?php
/**
 * featured_product Section options
 *
 * @package Theme Palace
 * @subpackage Shopall Pro
 * @since Shopall Pro 1.0.0
 */
if ( !class_exists('WooCommerce') ) {
	return;
}
// Add featured_product section
$wp_customize->add_section( 'shopall_featured_product_section', array(
	'title'             => esc_html__( 'Featured Product','shopall' ),
	'description'       => esc_html__( 'Featured Product Section options.', 'shopall' ),
	'panel'             => 'shopall_front_page_panel',
) );

// featured_product content enable control and setting
$wp_customize->add_setting( 'shopall_theme_options[featured_product_section_enable]', array(
	'default'			=> 	$options['featured_product_section_enable'],
	'sanitize_callback' => 'shopall_sanitize_switch_control',
) );

$wp_customize->add_control( new Shopall_Switch_Control( $wp_customize, 'shopall_theme_options[featured_product_section_enable]', array(
	'label'             => esc_html__( 'Featured Product Section Enable', 'shopall' ),
	'section'           => 'shopall_featured_product_section',
	'on_off_label' 		=> shopall_switch_options(),
) ) );

$wp_customize->add_setting( 'shopall_theme_options[featured_product_count]', array(
	'default'          	=> $options['featured_product_count'],
	'sanitize_callback' => 'shopall_sanitize_number_range',
	'validate_callback' => 'shopall_validate_featured_product_count',
) );

$wp_customize->add_control( 'shopall_theme_options[featured_product_count]', array(
	'label'             => esc_html__( 'Number of Product', 'shopall' ),
	'description'       => esc_html__( 'Note: Min 1 & Max 12. Please input the valid number and save. Then refresh the page to see the change.', 'shopall' ),
	'section'           => 'shopall_featured_product_section',
	'active_callback'   => 'shopall_is_featured_product_section_enable',
	'type'				=> 'number',
	'input_attrs'		=> array(
		'min'	=> 1,
		'max'	=> 12,
		'style' => 'width: 100px;'
		),
) );

for ( $i = 1; $i <= $options['featured_product_count']; $i++ ) :
	// featured_product pages drop down chooser control and setting
	$wp_customize->add_setting( 'shopall_theme_options[featured_product_content_page_' . $i . ']', array(
		'sanitize_callback' => 'shopall_sanitize_page',
	) );

	$wp_customize->add_control( new Shopall_Dropdown_Chooser( $wp_customize, 'shopall_theme_options[featured_product_content_page_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Page %d', 'shopall' ), $i ),
		'section'           => 'shopall_featured_product_section',
		'choices'			=> shopall_page_choices(),
		'active_callback' 	=> 'shopall_is_featured_product_section_enable',
	) ) );

	$options['featured_product_btn_title_'.$i] = isset($options['featured_product_btn_title_'.$i]) ? $options['featured_product_btn_title_'.$i] : esc_html__('Start Shopping', 'shopall') ;
	$wp_customize->add_setting( 'shopall_theme_options[featured_product_btn_title_'.$i.']', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'			=> $options['featured_product_btn_title_'.$i],
	) );

	$wp_customize->add_control( 'shopall_theme_options[featured_product_btn_title_'.$i.']', array(
		'label'           	=> sprintf( esc_html__( 'Button Label %d', 'shopall' ), $i ),
		'section'        	=> 'shopall_featured_product_section',
		'active_callback' 	=> 'shopall_is_featured_product_section_enable',
		'type'				=> 'text',
	) );

	// blog btn title setting and control
	$wp_customize->add_setting( 'shopall_theme_options[featured_product_btn_url_'.$i.']', array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'shopall_theme_options[featured_product_btn_url_'.$i.']', array(
		'label'           	=> sprintf( esc_html__( 'Button Url %d', 'shopall' ), $i ),
		'section'        	=> 'shopall_featured_product_section',
		'active_callback' 	=> 'shopall_is_featured_product_section_enable',
		'type'				=> 'url',
	) );

    $wp_customize->add_setting( 'shopall_theme_options[featured_product_hr_'. $i .']', array(
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new Shopall_Customize_Horizontal_Line( $wp_customize, 'shopall_theme_options[featured_product_hr_'. $i .']',
        array(
            'section'           => 'shopall_featured_product_section',
            'active_callback'   => 'shopall_is_featured_product_section_enable',
            'type'            => 'hr'
    ) ) );
endfor;
