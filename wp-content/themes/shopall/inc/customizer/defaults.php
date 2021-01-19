<?php
/**
 * Customizer default options
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 * @return array An array of default values
 */

function shopall_get_default_theme_options() {
	$theme_data = wp_get_theme();
	$shopall_default_options = array(
		// Color Options
		'header_title_color'			=> '#010101',
		'header_tagline_color'			=> '#010101',
		'header_txt_logo_extra'			=> 'show-all',
		'colorscheme_hue'				=> '#fa311f',
		'colorscheme'					=> 'default',
		'theme_version'					=> 'lite-version',
		
		// typography Options
		'theme_typography' 				=> 'default',
		'body_theme_typography' 		=> 'default',
		
		// loader
		'loader_enable'         		=> false,
		'loader_icon'         			=> 'default',

		// breadcrumb
		'breadcrumb_enable'				=> true,
		'breadcrumb_separator'			=> '/',
		
		// layout 
		'site_layout'         			=> 'wide-layout',
		'sidebar_position'         		=> 'right-sidebar',
		'post_sidebar_position' 		=> 'right-sidebar',
		'page_sidebar_position' 		=> 'right-sidebar',
		'menu_sticky'					=> false,
		'social_nav_enable'				=> false,
		'register_link'					=> '',
		'sign_in_link'					=> '',

		// excerpt options
		'long_excerpt_length'           => 25,
		
		// pagination options
		'pagination_enable'         	=> true,
		'pagination_type'         		=> 'default',

		// footer options
		'copyright_text'           		=> sprintf( esc_html_x( 'Copyright &copy; %1$s %2$s', '1: Year, 2: Site Title with home URL', 'shopall' ), '[the-year]', '[site-link]' ),
		'footer_social_enable'			=> false,
		'scroll_top_visible'        	=> false,

		// reset options
		'reset_options'      			=> false,
		
		// homepage options
		'enable_frontpage_content' 		=> false,

		// homepage sections sortable
		'sortable' 						=> 'slider,service,recent_product,featured_product,blog',

		// blog/archive options
		'your_latest_posts_title' 		=> esc_html__( 'Blogs', 'shopall' ),
		'hide_date' 					=> false,
		'hide_category'					=> false,
		'hide_author'					=> false,

		// single post theme options
		'single_post_hide_date' 		=> false,
		'single_post_hide_author'		=> false,
		'single_post_hide_category'		=> false,
		'single_post_hide_tags'			=> false,

		/* Front Page */

		'nav_search_enable'				=> true,

		// topbar
		'topbar_section_enable'			=> false,
		'topbar_title'					=> esc_html__( 'WINTER CLEARANCE: Take 20 percent off Sale of The Year', 'shopall' ),
	
		
		// slider search
		'slider_section_enable'			=> false,
		'slider_content_type'			=> 'page',
		'slider_autoplay'				=> false,
		'slider_count'					=> 3,
		'slider_sub_title'				=> esc_html__( 'Limited Edition', 'shopall' ),
		'slider_offer_label'			=> esc_html__( 'New arrivals are here! Get 20% off', 'shopall' ),
		'slider_btn_label'				=> esc_html__( 'View Collection', 'shopall' ),

		//service 
		'service_section_enable'		=> false,
		'service_content_type'			=> 'page',
		'service_count'					=> 3,
		'service_column_layout'			=> 'col-3',

		'recent_product_section_enable'		=> false,
		'recent_product_content_type'		=> 'product',
		'recent_product_count'				=> 3,
		'recent_product_title'				=> esc_html__( 'Recent Products', 'shopall' ),


		'featured_product_section_enable'		=> false,
		'featured_product_content_type'			=> 'page',
		'featured_product_count'				=> 2,

		// blog
		'blog_section_enable'			=> false,
		'blog_content_type'				=> 'recent',
		'blog_count'					=> 3,
		'blog_title'					=> esc_html__( 'Our Fresh Stories', 'shopall' ),

	);

	for ($i=1; $i <= 2 ; $i++) { 
		$shopall_default_options['featured_product_btn_title_'.$i] = esc_html__('Start Shopping', 'shopall');
		$shopall_default_options['featured_product_btn_url_'.$i] = '';
	}

	$output = apply_filters( 'shopall_default_theme_options', $shopall_default_options );

	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}