<?php
/**
 * Theme Palace basic theme structure hooks
 *
 * This file contains structural hooks.
 *
 * @package Theme Palace
 * @subpackage shopall
 * @since shopall 1.0.0
 */




if ( ! function_exists( 'shopall_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since shopall 1.0.0
	 */
	function shopall_doctype() {
	?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
	<?php
	}
endif;

add_action( 'shopall_doctype', 'shopall_doctype', 10 );


if ( ! function_exists( 'shopall_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since shopall 1.0.0
	 *
	 */
	function shopall_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
		<?php endif;
	}
endif;
add_action( 'shopall_before_wp_head', 'shopall_head', 10 );

if ( ! function_exists( 'shopall_page_start' ) ) :
	/**
	 * Page starts html codes
	 *
	 * @since shopall 1.0.0
	 *
	 */
	function shopall_page_start() {
		?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'shopall' ); ?></a>
			<div class="menu-overlay"></div>

		<?php
	}
endif;
add_action( 'shopall_page_start_action', 'shopall_page_start', 10 );

if ( ! function_exists( 'shopall_page_end' ) ) :
	/**
	 * Page end html codes
	 *
	 * @since shopall 1.0.0
	 *
	 */
	function shopall_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'shopall_page_end_action', 'shopall_page_end', 10 );

if ( ! function_exists( 'shopall_topbar' ) ) :
	/**
	 * Topbar html codes
	 *
	 * @since shopall 1.0.0
	 *
	 */
	function shopall_topbar() { 
		$options = shopall_get_theme_options(); 

		if ( $options['topbar_section_enable'] == true ): ?>
			<div id="top-bar" class="relative">
	            <div class="wrapper">
	                <span><?php echo wp_kses_post( $options['topbar_title'] ) ?></span>
	            </div><!-- .wrapper -->
	        </div><!-- #top-bar -->
		<?php
		endif;
	}
endif;
add_action( 'shopall_header_action', 'shopall_topbar', 10 );

if ( ! function_exists( 'shopall_header_start' ) ) :
	/**
	 * Header start html codes
	 *
	 * @since shopall 1.0.0
	 *
	 */
	function shopall_header_start() { 
		$options = shopall_get_theme_options();
		?>
		<header id="masthead" class="site-header" role="banner">
			<div class="site-branding-wrapper col-3">
				<div class="wrapper">
					<?php if ( $options['social_nav_enable'] == true ): ?>
						<div class="social-menu">
	                        <?php 
	                        	$search = '';
								
								$search .= '<li class="search-menu">';
								$search .= '<a href="#" class="">';
								$search .= shopall_get_svg( array( 'icon' => 'search' ) );
								$search .= shopall_get_svg( array( 'icon' => 'close' ) );
								$search .= '</a><div id="search">';
								$search .= get_search_form( $echo = false );
				                $search .= '</div></li>';
			            	
			            		wp_nav_menu( array(
			            			'theme_location' => 'social',
			            			'container' => false,
			            			'menu_class' => 'social-icons',
			            			'echo' => true,
			            			'fallback_cb' => false,
			            			'depth' => 1,
			            			'link_before' => '<span class="screen-reader-text">',
									'link_after' => '</span>',
									'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s' . $search . '</ul>',
			            		) );
			            	?>
	                    </div><!-- .social-menu -->
					<?php endif; 
					
		
	}
endif;
add_action( 'shopall_header_action', 'shopall_header_start', 20 );

if ( ! function_exists( 'shopall_site_branding' ) ) :
	/**
	 * Site branding codes
	 *
	 * @since shopall 1.0.0
	 *
	 */
	function shopall_site_branding() {
		$options  = shopall_get_theme_options();
		$header_txt_logo_extra = $options['header_txt_logo_extra'];		
		?>		
		<div class="site-branding">
			<?php if ( in_array( $header_txt_logo_extra, array( 'show-all', 'logo-title', 'logo-tagline' ) )  ) { ?>
				<div class="site-logo">
					<?php the_custom_logo(); ?>
				</div>
			<?php } 
			if ( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title', 'show-all', 'tagline-only', 'logo-tagline' ) ) ) : ?>
				<div id="site-details">
					<?php
					if( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title' ) )  ) {
						if ( shopall_is_latest_posts() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
						endif;
					} 
					if ( in_array( $header_txt_logo_extra, array( 'show-all', 'tagline-only', 'logo-tagline' ) ) ) {
						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
						<?php
						endif; 
					}?>
				</div>
	    	<?php endif; ?>
		</div><!-- .site-branding -->
		<ul class="login-register">
			<?php if ( $options['register_link'] !== '' || $options['sign_in_link'] !== '' ): ?>
				<li>
	                <?php echo shopall_get_svg( array( 'icon' => 'user') ) ; ?>
	                <?php if ( $options['register_link'] !== '' ): ?>
	                	<a href="<?php echo esc_url($options['register_link']) ; ?>"><?php esc_html_e( 'Register', 'shopall' ) ; ?></a>
	                <?php endif ?>
	                <?php if ( $options['register_link'] !== '' && $options['sign_in_link'] !== '' ): ?>
	                	<?php esc_html_e( 'or', 'shopall' ) ; ?> 
	                <?php endif ?>
	                <?php if ( $options['sign_in_link'] !== '' ): ?>
	                	<a href="<?php echo esc_url($options['sign_in_link']) ; ?>"><?php esc_html_e( 'Sign in', 'shopall' ) ; ?></a>
	                <?php endif ?>	                
	            </li>	
			<?php endif ?>
			
			
           <?php if ( class_exists('WooCommerce') ): ?>
	   			<li class="cart-count">
	       		 	<a href="<?php echo wc_get_cart_url(); ?>">
	       		 		<?php 
	       		 			echo esc_html_e( ' CART ', 'shopall' ); 
	       		 			if ( WC()->cart->get_cart_contents_count() > 0 ) {
	       		 				echo '('.WC()->cart->get_cart_contents_count().')';
	       		 			 }
	       		 			echo shopall_get_svg( array( 'icon' => 'cart' ) ); 

	       		 		?>
	           		</a>
	            </li>
           	<?php  endif ; ?>             
        </ul>
	</div><!-- .wrapper -->
</div><!-- .wrapper -->
		<?php
	}
endif;
add_action( 'shopall_header_action', 'shopall_site_branding', 20 );

if ( ! function_exists( 'shopall_site_navigation' ) ) :
	/**
	 * Site navigation codes
	 *
	 * @since shopall 1.0.0
	 *
	 */
	function shopall_site_navigation() {
		$options = shopall_get_theme_options();
		?>
		<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php echo esc_attr__( 'Primary Menu', 'shopall' ) ?>">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span class="menu-label"><?php esc_html_e( 'Menu', 'shopall' ); ?></span>			
				<?php
				echo shopall_get_svg( array( 'icon' => 'menu' ) );
				echo shopall_get_svg( array( 'icon' => 'close' ) );
				?>		
			</button>
				<?php 	        	
	        		wp_nav_menu( array(
	        			'theme_location' => 'primary',
	        			'container' => 'div',
	        			'menu_class' => 'menu nav-menu',
	        			'menu_id' => 'primary-menu',
	        			'echo' => true,
	        			'fallback_cb' => 'shopall_menu_fallback_cb',
	        		) );
	        	?>
        	
		</nav><!-- #site-navigation -->
		<?php
	}
endif;
add_action( 'shopall_header_action', 'shopall_site_navigation', 30 );


if ( ! function_exists( 'shopall_header_end' ) ) :
	/**
	 * Header end html codes
	 *
	 * @since shopall 1.0.0
	 *
	 */
	function shopall_header_end() {
		?>
			
		</header><!-- #masthead -->
		<?php
	}
endif;

add_action( 'shopall_header_action', 'shopall_header_end', 50 );

if ( ! function_exists( 'shopall_content_start' ) ) :
	/**
	 * Site content codes
	 *
	 * @since shopall 1.0.0
	 *
	 */
	function shopall_content_start() {
		?>
		<div id="content" class="site-content">
		<?php
	}
endif;
add_action( 'shopall_content_start_action', 'shopall_content_start', 10 );

if ( ! function_exists( 'shopall_header_image' ) ) :
	/**
	 * Header Image codes
	 *
	 * @since shopall 1.0.0
	 *
	 */
	function shopall_header_image() {
		if ( shopall_is_frontpage() )
			return;
		$header_image = get_header_image();
		if ( is_singular() ) :
			$header_image = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'full' ) : $header_image;
		endif;
		?>

		<div id="page-site-header" class="relative" style="background-image: url('<?php echo esc_url( $header_image ); ?>');">
            <div class="overlay"></div>
            <div class="wrapper">
                <header class="page-header">
                    <h2 class="page-title"><?php shopall_custom_header_banner_title(); ?></h2>
                </header>

                <?php shopall_add_breadcrumb(); ?>
            </div><!-- .wrapper -->
        </div><!-- #page-site-header -->
		<?php
	}
endif;
add_action( 'shopall_header_image_action', 'shopall_header_image', 10 );

if ( ! function_exists( 'shopall_add_breadcrumb' ) ) :
	/**
	 * Add breadcrumb.
	 *
	 * @since shopall 1.0.0
	 */
	function shopall_add_breadcrumb() {
		$options = shopall_get_theme_options();
		// Bail if Breadcrumb disabled.
		$breadcrumb = $options['breadcrumb_enable'];
		if ( false === $breadcrumb ) {
			return;
		}
		
		// Bail if Home Page.
		if ( shopall_is_frontpage() ) {
			return;
		}

		echo '<div id="breadcrumb-list">';
				/**
				 * shopall_simple_breadcrumb hook
				 *
				 * @hooked shopall_simple_breadcrumb -  10
				 *
				 */
				do_action( 'shopall_simple_breadcrumb' );
		echo '</div><!-- #breadcrumb-list -->';
		return;
	}
endif;
add_action( 'shopall_header_image_action', 'shopall_add_breadcrumb', 20 );

if ( ! function_exists( 'shopall_content_end' ) ) :
	/**
	 * Site content codes
	 *
	 * @since shopall 1.0.0
	 *
	 */
	function shopall_content_end() {
		?>
			<div class="menu-overlay"></div>
		</div><!-- #content -->
		<?php
	}
endif;
add_action( 'shopall_content_end_action', 'shopall_content_end', 10 );

if ( ! function_exists( 'shopall_footer_start' ) ) :
	/**
	 * Footer starts
	 *
	 * @since shopall 1.0.0
	 *
	 */
	function shopall_footer_start() {
		$options = shopall_get_theme_options();
		$logo = isset( $options['footer_logo'] ) ?  $options['footer_logo'] : '';
		?>
		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php if ( $logo !== ''): ?>
			<div class="footer-logo wrapper">
                <img src="<?php echo esc_url( $logo ) ; ?>" alt="<?php esc_attr_e( 'footer logo', 'shopall' ) ; ?>">
            </div><!-- .footer-logo -->
			<?php endif;
	}
endif;
add_action( 'shopall_footer', 'shopall_footer_start', 10 );

if ( ! function_exists( 'shopall_footer_site_info' ) ) :
	/**
	 * Footer starts
	 *
	 * @since shopall 1.0.0
	 *
	 */
	function shopall_footer_site_info() {
		$options = shopall_get_theme_options();
		$search = array( '[the-year]', '[site-link]' );

        $replace = array( date( 'Y' ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name' ) ) . '</a>' );

        $options['copyright_text'] = str_replace( $search, $replace, $options['copyright_text'] );

		$copyright_text = $options['copyright_text']; 
		?>
		
		<div class="site-info <?php echo $options['footer_social_enable'] == true ? 'col-2' : '' ?>">
            <div class="wrapper">
                <span>
                	<?php 
                		echo shopall_santize_allow_tag( $copyright_text ); 
                	?>
                	<?php echo esc_html__(' / Theme By Themepalace', 'shopall'); ?>
            	</span>
            	
        		<?php if ( $options['footer_social_enable'] == true ):   
            		$footer = array(
            			'theme_location' => 'social',
            			'container' => false,
            			'menu_class' => 'social-icons',
            			'echo' => true,
            			'fallback_cb' => false,
            			'depth' => 1,
            			'link_before' => '<span class="screen-reader-text">',
						'link_after' => '</span>',
            		);
            	
            		wp_nav_menu( $footer );
            	endif; ?>
            	
            </div><!-- .wrapper -->    
        </div><!-- .site-info -->

		<?php
	}
endif;
add_action( 'shopall_footer', 'shopall_footer_site_info', 40 );

if ( ! function_exists( 'shopall_footer_scroll_to_top' ) ) :
	/**
	 * Footer starts
	 *
	 * @since shopall 1.0.0
	 *
	 */
	function shopall_footer_scroll_to_top() {
		$options  = shopall_get_theme_options();
		if ( true === $options['scroll_top_visible'] ) : ?>
			<div class="backtotop"><?php echo shopall_get_svg( array( 'icon' => 'up' ) ); ?></div>
		<?php endif;
	}
endif;
add_action( 'shopall_footer', 'shopall_footer_scroll_to_top', 40 );

if ( ! function_exists( 'shopall_footer_end' ) ) :
	/**
	 * Footer starts
	 *
	 * @since shopall 1.0.0
	 *
	 */
	function shopall_footer_end() {
		?>
		</footer>
		<div class="popup-overlay"></div>
		<?php
	}
endif;
add_action( 'shopall_footer', 'shopall_footer_end', 100 );

if ( ! function_exists( 'shopall_loader' ) ) :
	/**
	 * Start div id #loader
	 *
	 * @since shopall 1.0.0
	 *
	 */
	function shopall_loader() {
		$options = shopall_get_theme_options();
		if ( $options['loader_enable'] ) { ?>

			<div id="loader">
            <div class="loader-container">
            	<?php if ( 'default' == $options['loader_icon'] ) : ?>
	                <div id="preloader">
	                    <span></span>
	                    <span></span>
	                    <span></span>
	                    <span></span>
	                    <span></span>
	                </div>
	            <?php else :
	            	echo shopall_get_svg( array( 'icon' => esc_attr( $options['loader_icon'] ) ) );
	            endif; ?>
            </div>
        </div><!-- #loader -->
		<?php }
	}
endif;
add_action( 'shopall_before_header', 'shopall_loader', 10 );

if ( ! function_exists( 'shopall_infinite_loader_spinner' ) ) :
	/**
	 *
	 * @since shopall 1.0.0
	 *
	 */
	function shopall_infinite_loader_spinner() { 
		$id = get_the_ID();
		$options = shopall_get_theme_options();
		if ( $options['pagination_type'] == 'infinite' ) :
			if ( ! empty( $id ) ) {
				echo '<div class="blog-loader">' . shopall_get_svg( array( 'icon' => 'spinner-umbrella' ) ) . '</div>';
			}
		endif;
	}
endif;
add_action( 'shopall_infinite_loader_spinner_action', 'shopall_infinite_loader_spinner', 10 );
