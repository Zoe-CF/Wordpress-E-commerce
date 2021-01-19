<?php
/**
 * Sanitization Functions
 * 
 * @package     Remax_Store
 * @author      Themerelic
 * @copyright   Copyright (c) 2018, Themerelic
 * @link        http://themerelic.com
 * @since       Remax_Store 1.0.0
 * */
 

/**
 * Sanitize callback for checkbox
 *  @since 1.0.0
*/
function remax_store_sanitize_checkbox( $checked ){
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Sanitize callback for select
*/
function remax_store_sanitize_select( $value ){
    if ( is_array( $value ) ) {
		foreach ( $value as $key => $subvalue ) {
			$value[ $key ] = esc_attr( $subvalue );
		}
		return $value;
	}
	return esc_attr( $value );
}



function remax_store_sanitize_multiple_check( $value ) {                        
    $value = ( ! is_array( $value ) ) ? explode( ',', $value ) : $value;
    return ( ! empty( $value ) ) ? array_map( 'sanitize_text_field', $value ) : array();    
}

function remax_store_sanitize_sortable( $value = array() ) {
	if ( is_string( $value ) || is_numeric( $value ) ) {
		return array(
			esc_attr( $value ),
		);
	}
	$sanitized_value = array();
	foreach ( $value as $sub_value ) {
		$sanitized_value[] = esc_attr( $sub_value );
	}
	return $sanitized_value;
}
