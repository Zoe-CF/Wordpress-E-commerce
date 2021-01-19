<?php
/**
 * The template for displaying home page.
 * Template Name: Front Page Template
 * @package Remax Store
 */

get_header();
if ( 'posts' == get_option( 'show_on_front' ) ) {
    /**
     * Lode the Blog Section
     * 
     * this function is call for load the blog section,
     * 
     * @since 1.0.0
     */
    load_template( get_home_template() );
} else {
    /**
     * Front page All settings is hear
     * @param string $homepage_functions is call the frontend section call
     * @since 1.0.0
     */
    foreach( get_theme_mod('remax_store_home_page_sort',remax_store_customizer_section()) as $homepage_item ){

        /**
         * Explode the string value
         * 
         * @since 1.0.0
         * @return string
         */
        $homepage_item = explode("-",$homepage_item);

        
        /**
         * check the conditions
         * 
         * @since 1.0.0
         */
        if( $homepage_item[0] == 'remax_store_homepage_products_tabs' ){
            remax_store_homepage_single_products_sec( $homepage_item[1] );
        }else{
            //products count hear
            $homepage_function = $homepage_item[0];
            $homepage_function();
        }

        
    }

}
get_footer();