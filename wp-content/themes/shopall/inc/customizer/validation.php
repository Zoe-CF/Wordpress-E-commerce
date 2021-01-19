<?php
/**
* Customizer validation functions
*
* @package Theme Palace
* @subpackage shopall
* @since shopall 1.0.0
*/

if ( ! function_exists( 'shopall_validate_long_excerpt' ) ) :
  function shopall_validate_long_excerpt( $validity, $value ){
		 $value = intval( $value );
	 if ( empty( $value ) || ! is_numeric( $value ) ) {
		 $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'shopall' ) );
	 } elseif ( $value < 5 ) {
		 $validity->add( 'min_no_of_words', esc_html__( 'Minimum no of words is 5', 'shopall' ) );
	 } elseif ( $value > 100 ) {
		 $validity->add( 'max_no_of_words', esc_html__( 'Maximum no of words is 100', 'shopall' ) );
	 }
	 return $validity;
  }
endif;

if ( ! function_exists( 'shopall_validate_slider_count' ) ) :
  function shopall_validate_slider_count( $validity, $value ){
		 $value = intval( $value );
	 if ( empty( $value ) || ! is_numeric( $value ) ) {
		 $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'shopall' ) );
	 } elseif ( $value < 1 ) {
		 $validity->add( 'min_no_of_posts', esc_html__( 'Minimum no of posts is 1', 'shopall' ) );
	 } elseif ( $value > 10 ) {
		 $validity->add( 'max_no_of_posts', esc_html__( 'Maximum no of posts is 10', 'shopall' ) );
	 }
	 return $validity;
  }
endif;


if ( ! function_exists( 'shopall_validate_service_count' ) ) :
  function shopall_validate_service_count( $validity, $value ){
		 $value = intval( $value );
	 if ( empty( $value ) || ! is_numeric( $value ) ) {
		 $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'shopall' ) );
	 } elseif ( $value < 3 ) {
		 $validity->add( 'min_no_of_posts', esc_html__( 'Minimum no of service is 3', 'shopall' ) );
	 } elseif ( $value > 12 ) {
		 $validity->add( 'max_no_of_posts', esc_html__( 'Maximum no of service is 12', 'shopall' ) );
	 }
	 return $validity;
  }
endif;


if ( ! function_exists( 'shopall_validate_blog_count' ) ) :
  function shopall_validate_blog_count( $validity, $value ){
		 $value = intval( $value );
	 if ( empty( $value ) || ! is_numeric( $value ) ) {
		 $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'shopall' ) );
	 } elseif ( $value < 1 ) {
		 $validity->add( 'min_no_of_posts', esc_html__( 'Minimum no of posts is 1', 'shopall' ) );
	 } elseif ( $value > 12 ) {
		 $validity->add( 'max_no_of_posts', esc_html__( 'Maximum no of posts is 12', 'shopall' ) );
	 }
	 return $validity;
  }
endif;

if ( ! function_exists( 'shopall_validate_featured_product_count' ) ) :
  function shopall_validate_featured_product_count( $validity, $value ){
		 $value = intval( $value );
	 if ( empty( $value ) || ! is_numeric( $value ) ) {
		 $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'shopall' ) );
	 } elseif ( $value < 1 ) {
		 $validity->add( 'min_no_of_posts', esc_html__( 'Minimum no of posts is 1', 'shopall' ) );
	 } elseif ( $value > 12 ) {
		 $validity->add( 'max_no_of_posts', esc_html__( 'Maximum no of posts is 12', 'shopall' ) );
	 }
	 return $validity;
  }
endif;

if ( ! function_exists( 'shopall_validate_recent_product_count' ) ) :
  function shopall_validate_recent_product_count( $validity, $value ){
		 $value = intval( $value );
	 if ( empty( $value ) || ! is_numeric( $value ) ) {
		 $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'shopall' ) );
	 } elseif ( $value < 1 ) {
		 $validity->add( 'min_no_of_posts', esc_html__( 'Minimum no of posts is 1', 'shopall' ) );
	 } elseif ( $value > 12 ) {
		 $validity->add( 'max_no_of_posts', esc_html__( 'Maximum no of posts is 12', 'shopall' ) );
	 }
	 return $validity;
  }
endif;

if ( ! function_exists( 'shopall_validate_client_count' ) ) :
  function shopall_validate_client_count( $validity, $value ){
		 $value = intval( $value );
	 if ( empty( $value ) || ! is_numeric( $value ) ) {
		 $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'shopall' ) );
	 } elseif ( $value < 1 ) {
		 $validity->add( 'min_no_of_posts', esc_html__( 'Minimum no of logo is 1', 'shopall' ) );
	 } elseif ( $value > 12 ) {
		 $validity->add( 'max_no_of_posts', esc_html__( 'Maximum no of logo is 12', 'shopall' ) );
	 }
	 return $validity;
  }
endif;

if ( ! function_exists( 'shopall_validate_trending_product_count' ) ) :
  function shopall_validate_trending_product_count( $validity, $value ){
		 $value = intval( $value );
	 if ( empty( $value ) || ! is_numeric( $value ) ) {
		 $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'shopall' ) );
	 } elseif ( $value < 1 ) {
		 $validity->add( 'min_no_of_posts', esc_html__( 'Minimum no of logo is 1', 'shopall' ) );
	 } elseif ( $value > 12 ) {
		 $validity->add( 'max_no_of_posts', esc_html__( 'Maximum no of logo is 12', 'shopall' ) );
	 }
	 return $validity;
  }
endif;


if ( ! function_exists( 'shopall_validate_testimonial_count' ) ) :
  function shopall_validate_testimonial_count( $validity, $value ){
		 $value = intval( $value );
	 if ( empty( $value ) || ! is_numeric( $value ) ) {
		 $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'shopall' ) );
	 } elseif ( $value < 1 ) {
		 $validity->add( 'min_no_of_posts', esc_html__( 'Minimum no of testimonial is 1', 'shopall' ) );
	 } elseif ( $value > 12 ) {
		 $validity->add( 'max_no_of_posts', esc_html__( 'Maximum no of testimonial is 12', 'shopall' ) );
	 }
	 return $validity;
  }
endif;




























