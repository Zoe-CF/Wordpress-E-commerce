<?php
/**
 * Functions for Remax_Store Theme.
 *
 * @package     Remax_Store
 * @author      Themerelic
 * @copyright   Copyright (c) 2018, Themerelic
 * @link        http://themerelic.com
 * @since       Remax_Store 1.0.0
 * */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * Archive Page Title
 */
if ( ! function_exists( 'remax_store_archive_page_info' ) ) {

	/**
	 * Wrapper function for the_title()
	 *
	 * Displays title only if the page title bar is disabled.
	 */
	function remax_store_archive_page_info() {

		if ( apply_filters( 'remax_store_the_title_enabled', true ) ) {

			// Author.
			if ( is_author() ) { ?>

				<section class="remax-store-author-box remax-store-archive-description">
					<div class="remax-store-author-bio">
						<h1 class='page-title remax-store-archive-title'><?php echo get_the_author(); ?></h1>
						<p><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></p>
					</div>
					<div class="remax-store-author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'email' ), 120 ); ?>
					</div>
				</section>

				<?php

				// Category.
			} elseif ( is_category() ) {
				?>

				<section class="remax-store-archive-description">
					<h1 class="page-title remax-store-archive-title"><?php echo single_cat_title(); ?></h1>
					<?php the_archive_description(); ?>
				</section>

				<?php

				// Tag.
			} elseif ( is_tag() ) {
				?>

				<section class="remax-store-archive-description">
					<h1 class="page-title remax-store-archive-title"><?php echo single_tag_title(); ?></h1>
					<?php the_archive_description(); ?>
				</section>

				<?php

				// Search.
			} elseif ( is_search() ) {
				?>

				<section class="remax-store-archive-description">
					<?php
						/* translators: 1: search string */
						$title = apply_filters( 'remax_store_the_search_page_title', sprintf( __( 'Search Results for: %s', 'remax-store' ), get_search_query() ) );
					?>
					<h1 class="page-title remax-store-archive-title"> <?php echo esc_html( $title ); ?> </h1>
				</section>

				<?php

				// Other.
			} else {
				?>

				<section class="remax-store-archive-description">
					<?php the_archive_title( '<h1 class="page-title remax-store-archive-title">', '</h1>' ); ?>
					<?php the_archive_description(); ?>
				</section>

				<?php
			}
		}
	}

	add_action( 'remax_store_archive_header', 'remax_store_archive_page_info' );
}


/**
 * Remax Store Plugin required
 *
 *
 * @package Remax Store
 * @since 1.0.0
 */
function remax_store_register_required_plugins() {
    /*
    * The list of Plugin Requird List
    */
    $plugins = array(

        array(
            'name' => esc_html__( "WooCommerce", 'remax-store'),
            'slug' => 'woocommerce',
            'required' => false,
        ),
        array(
            'name' => esc_html__( 'YITH WooCommerce Quick View', 'remax-store'),
            'slug' => 'yith-woocommerce-quick-view',
            'required' => false,
        ),
        array(
            'name' => esc_html__( 'YITH WooCommerce Compare', 'remax-store'),
            'slug' => 'yith-woocommerce-compare',
            'required' => false,
        ),
        array(
            'name' => esc_html__( 'YITH WooCommerce Wishlist', 'remax-store'),
            'slug' => 'yith-woocommerce-wishlist',
            'required' => false,
        ),
        array(
            'name' => esc_html__( 'Contact Form 7', 'remax-store'),
            'slug' => 'contact-form-7',
            'required' => false,
        ),
        array(
            'name' => esc_html__( 'WooCommerce Grid / List toggle', 'remax-store'),
            'slug' => 'woocommerce-grid-list-toggle',
            'required' => false,
        )


    );

    /*
        * Array of configuration settings. Amend each line as needed. 
    */
    $config = array(
        'id'           => 'remax-store',                 
        'default_path' => '',                      
        'menu'         => 'tgmpa-install-plugins', 
        'has_notices'  => true,                    
        'dismissable'  => true,                    
        'dismiss_msg'  => '',                       
        'is_automatic' => false,                   
        'message'      => '',                      
        
    );

    tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register','remax_store_register_required_plugins' );//Register
