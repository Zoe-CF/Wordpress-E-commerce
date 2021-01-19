<?php
/**
 * General Settings Hear
 *
 * @package Remax_Store
 */

function remax_store_customize_general_settings( $wp_customize ) {
	
    /**
    * General Settings Panel
    */
    /** Enable/Disable Top Header Settings */
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    /** Remax_Store Logo Customizer */
    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array(
            'selector'        => '.site-title a',
            'render_callback' => 'remax_store_customize_partial_blogname',
        ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
            'selector'        => '.site-description',
            'render_callback' => 'remax_store_customize_partial_blogdescription',
        ) );
    }

    //Remax_Store Logo Setting
    $wp_customize->get_section('title_tagline')->panel = 'general_setting';
    $wp_customize->get_section('title_tagline' )->priority = 1;


    $wp_customize->get_section('header_image')->panel = 'general_setting';
    $wp_customize->get_section('header_image' )->priority = 2;

    $wp_customize->get_section('title_tagline' )->priority = 3;

     /**
    * General Settings Panel
    */
    $wp_customize->get_section('colors')->panel = 'general_setting';
    $wp_customize->get_control('header_textcolor' )->priority = 6;
    $wp_customize->get_control('background_color' )->priority = 7;
    $wp_customize->get_section('background_image')->panel = 'general_setting';
    

}
add_action( 'customize_register', 'remax_store_customize_general_settings' );