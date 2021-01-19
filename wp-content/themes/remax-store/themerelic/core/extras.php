<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package     Remax_Store
 * @author      Themerelic
 * @copyright   Copyright (c) 2018, Themerelic
 * @link        http://themerelic.com
 * @since       Remax_Store 1.0.0
 * */


 /*************************************Header****************************** */
/**
 * Remax_Store Header
*/
if ( ! function_exists( 'remax_store_header_section' ) ) {

	/**
	 * Remax_Store Header
	 *
	 * @since 1.0.0
	 * @return void            
	 */
	function remax_store_header_section(){
		$remax_store_header_image = get_header_image();
		
		?>
			<!-- th-mobile-menu -->
			<div class="th-mobile-menu">
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
					<?php remax_store_site_branding(); ?>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo esc_html__('Toggle navigation','remax-store'); ?>">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
								'container'		 =>	 'ul',
								'menu_class'	 =>  'navbar-nav mr-auto'
							) );
						?>
					</div>
				</nav>
			</div>
			<!-- end th-mobile-menu -->

			
			<header class="th-header" <?php if(!empty($remax_store_header_image)): ?> style="background:url(<?php echo esc_url($remax_store_header_image); ?>)" <?php endif; ?> >
				<div class="container">
					<?php remax_store_site_branding(); ?>
					<?php remax_store_menu(); ?>
					
					<div class="th-footer">
						<?php
							/**
							 * Menu Social media
							 * 
							 * Enable/disable the menu social media section.
							 * 
							 * @since 1.0.0
							 */
							if( get_theme_mod( 'remax_store_menu_social_media_enable',false ) ){
								remax_store_social_media(); //remax_store_social_media();  
							}
						?>
						
					</div>
				</div>
			</header>
		<?php
	}
}

add_action( 'remax_store_header', 'remax_store_header_section' );


/**
 * Remax_Store Site Branding
*/
if ( ! function_exists( 'remax_store_site_branding_sec' ) ) {

	/**
	 * Remax_Store Site Branding
	 *
	 * @since 1.0.0
	 * @return void            
	 */
	function remax_store_site_branding_sec(){
		?>
		<strong class="th-logo">
			<div class="site-branding">
				<?php the_custom_logo(); ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
				$remax_store_description = get_bloginfo( 'description', 'display' );
				if ( $remax_store_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo esc_html( $remax_store_description );  /* WPCS: xss ok. */ ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->
		</strong>
		<?php
	}
}

add_action( 'remax_store_site_branding', 'remax_store_site_branding_sec' );



/**
 * Remax_Store Menu
*/
if ( ! function_exists( 'remax_store_menu_settings' ) ) {

	/**
	 * Remax_Store Menu
	 *
	 * @since 1.0.0
	 * @return void            
	 */
	function remax_store_menu_settings(){
		?>
		<div class="th-navigation">
			<!-- nav menu -->
			<nav class="sidenav" data-sidenav data-sidenav-toggle="#sidenav-toggle">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'container'		 =>	 'ul',
						'menu_class'	 =>  'sidenav-menu'
					) );
				?>
			</nav>
			<!-- end nav menu -->


		</div><!-- #site-navigation -->
		<?php
	}
}

add_action( 'remax_store_menu', 'remax_store_menu_settings' );




/**
 * Remax_Store Header Cart
*/
if ( ! function_exists( 'remax_store_header_cart_settings' ) ) {

	/**
	 * Remax_Store Menu
	 *
	 * @since 1.0.0
	 * @return void            
	 */
	function remax_store_header_cart_settings(){
		?>
		<div class="th-header-cart">
			<div class="container">
				<div class="th-cart-item">
					
					<?php
						if(remax_store_is_woocommerce_activated()): 
							/**
							 * call the remax-store woocommerce object
							 * 
							 * @since 1.0.0
							 */
							$remax_store_woocommerce = new Remax_Store_Woocommerce();

							/**
							 * Call the woocommerce functions
							 * @since 1.0.0
							 */
							$remax_store_woocommerce->remax_store_woocommerce_top_wishlist();
							$remax_store_woocommerce->remax_store_woocommerce_header_cart();

						endif;
					?>
				</div>
			</div>
		</div>
		<?php
	}
}

add_action( 'remax_store_header_cart', 'remax_store_header_cart_settings' );

/*************************************Footer****************************** */

/**
 * Remax_Store Footer 
*/
if ( ! function_exists( 'remax_store_footer_section' ) ) {

	/**
	 * Remax_Store Footer
	 *
	 * @since 1.0.0
	 * @return void            
	 */
	function remax_store_footer_section(){
		?>
		<footer id="colophon" class="site-footer th-bottom-footer">
			<div class="container">
				<?php remax_store_footer_widgets();//footer widget area. ?>
				<div class="th-footer-copyright">
					<div class="row">
						<div class="col-md-7 col-sm-7 col-xs-12">
							<?php remax_store_footer_copyright();//footer copyright section. ?>
						</div>
						<?php 
							/**
							 * Footer Social Media section
							 * 
							 * @since 1.0.0
							 */
							if( get_theme_mod('remax_store_menu_footer_social_media_enable',false) ){
								echo '<div class="col-md-5 col-sm-5 col-xs-12">';
								remax_store_social_media();//footer copyright social
								echo '</div>';
							}
						?>
						
					</div>
				</div>
			</div>
		</footer><!-- #colophon -->
		<?php
	}
}

add_action( 'remax_store_footer', 'remax_store_footer_section' );


/**
 * Remax_Store Footer Widget 
*/
if ( ! function_exists( 'remax_store_footer_widget_section' ) ) {

	/**
	 * Remax_Store Footer Widget 
	 *
	 * @since 1.0.0
	 * @return void            
	 */
	function remax_store_footer_widget_section(){
		?>
		<?php if ( is_active_sidebar( 'footer-1' ) ||  is_active_sidebar( 'footer-2' )  || is_active_sidebar( 'footer-3' ) ) : ?>
			<div class="remax-store-footer-widget">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<?php dynamic_sidebar( 'footer-2' ); ?>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<?php dynamic_sidebar( 'footer-3' ); ?>
					</div>
				</div>
			</div><!-- .site-info -->
		<?php endif; ?>
		<?php
	}
}

add_action( 'remax_store_footer_widgets', 'remax_store_footer_widget_section' );


/**
 * Remax_Store Footer Copyright 
*/
if ( ! function_exists( 'remax_store_footer_copyright_section' ) ) {

	/**
	 * Remax_Store Footer Copyright 
	 *
	 * @since 1.0.0
	 * @return void            
	 */
	function remax_store_footer_copyright_section(){
		?>
		<div class="site-info">
			<a target="_blank" href="<?php echo esc_url( __( 'https://wordpress.org/', 'remax-store' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'remax-store' ), 'WordPress' );
				?>
			</a>
			<span class="sep">|</span>
			<a target="_blank" href="<?php echo esc_url('https://themerelic.com','remax-store'); ?>">
				<?php
					/* translators: 1: Theme name, 2: Theme author. */
					printf( esc_html__( 'Theme: %1$s by %2$s.', 'remax-store' ), 'Remax Store', 'Themerelic' );
				?>
			<!-- .site-info -->
			</a>
		</div>

		<?php
	}
}

add_action( 'remax_store_footer_copyright', 'remax_store_footer_copyright_section' );


/**
 * Remax_Store Footer Social Media 
*/
if ( ! function_exists( 'remax_store_footer_social_media_section' ) ) {

	/**
	 * Remax_Store Footer Social Media
	 *
	 * @since 1.0.0
	 * @return void            
	 */
	function remax_store_footer_social_media_section(){
		/**
		 * Get customizer values 
		 * 
		 * @param string $facebook_url		|  get the social media facebook url
		 * @param string $twitter_url		|  get the social media twitter url
		 * @param string $google_plus_url	|  get the social media google_plus url
		 * @param string $youtube_url		|  get the social media youtube url
		 * @param string $instagram_url		|  get the social media instagram url
		 * @since 1.0.0
		 */
		$facebook_url 		= get_theme_mod('remax_store_social_facebook_url','https://facebook.com/');
		$twitter_url 		= get_theme_mod('remax_store_social_twitter_url','https://twitter.com/');
		$google_plus_url 	= get_theme_mod('remax_store_social_plus_goolge_url','https://plus.google.com');
		$youtube_url 		= get_theme_mod('remax_store_social_youtube_url','https://youtube.com/');
		$instagram_url 		= get_theme_mod('remax_store_social_instagram_url','https://instagram.com/');

		?>
		<div class="th-social">
			<ul>
				<?php if( $facebook_url != '' ): ?><li class="facebook"><a href="<?php echo esc_url( $facebook_url ); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li><?php endif; ?>
				<?php if( $twitter_url != '' ): ?><li class="twitter"><a href="<?php echo esc_url( $twitter_url ); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li><?php endif; ?>
				<?php if( $google_plus_url != '' ): ?><li class="google-plus"><a href="<?php echo esc_url( $google_plus_url ); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li><?php endif; ?>
				<?php if( $youtube_url != '' ): ?><li class="youtube"><a href="<?php echo esc_url( $youtube_url ); ?>"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li><?php endif; ?>
				<?php if( $instagram_url != '' ): ?><li class="instagram"><a href="<?php echo esc_url( $instagram_url ); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li><?php endif; ?>
			</ul>
		</div>
		<?php
	}
}

add_action( 'remax_store_social_media', 'remax_store_footer_social_media_section' );



/*************************************Content****************************** */

/** 
 *  Remax_Store Breadcrumb Section Functions Hear
 *  */
if ( ! function_exists( 'remax_store_breadcrumb_section' ) ) {
	/**
	 * Remax_Store Breadcrumb Section
	 * 
	 * @since Remax_Store 1.0.0
	 */

	function remax_store_breadcrumb_section() {
		
		//Enable Breadcrumb Section 
		if( get_theme_mod('remax_store_breadcrumb_enable',true ) == true  ){
			global $post;

			$remax_store_breadcrumb_separator = '<span class="separator"> / </span>';
			echo '<div class="remax-store-sticky-header" id="remax-store-sticky-header"><section class="breadcrumb"><div class="container"><div class="row"><div class="col-md-12"><div class="breadcrumb_wrap">';
			if (!is_home()) {
				echo '<div class="breadcrumb-section">';
				
				echo '<i class="fa fa-home" aria-hidden="true"></i><a href="';
				echo esc_url( home_url( ' / ' ) );
				echo '">';
				echo esc_html__('Home', 'remax-store');
				echo '</a>'.wp_kses_post( $remax_store_breadcrumb_separator ) ;
				if ( is_category() || is_single()) {
					the_category( $remax_store_breadcrumb_separator );
					if (is_single()) {
						echo ''.wp_kses_post( $remax_store_breadcrumb_separator );
						the_title();
					}
				} elseif ( is_page() ) {
					if($post->post_parent){
						$title = get_the_title();
						
						echo '<span title="'.esc_attr($title).'"> '.esc_html($title).'</span>';
					} else {
						echo '<span> '. esc_html(get_the_title()).'</span>';
					}
				}
				elseif (is_tag()) {single_tag_title();}
				elseif (is_day()) {echo "<span>" . sprintf(esc_html__('Archive for %s', 'remax-store'), esc_html( get_the_time('F jS, Y') ) ); echo '</span>';}
				elseif (is_month()) {echo "<span>" . sprintf(esc_html__('Archive for %s', 'remax-store'), esc_html( get_the_time('F, Y') ) ); echo '</span>';}
				elseif (is_year()) {echo "<span>" . sprintf(esc_html__('Archive for %s', 'remax-store'), esc_html( get_the_time('Y') ) ); echo '</span>';}
				elseif (is_author()) {echo "<span>" . esc_html__('Author Archive', 'remax-store'); echo '</span>';}
				elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<span>" . esc_html__('Blog Archives', 'remax-store'); echo '</span>';}
				elseif (is_search()) {echo "<span>" . esc_html__('Search Results', 'remax-store'); echo '</span>';}
				
				echo '</div>';
			} else {
				echo '<div class="breadcrumbs-section">';
				
				echo '<a href="';
				echo esc_url( home_url( '/' ) );
				echo '">';
				echo esc_html__('Home', 'remax-store');
				echo '</a>'.wp_kses_post( $remax_store_breadcrumb_separator );
				
				echo esc_html__('Blog', 'remax-store');
				
				
				echo '</div>';
			}

			echo "</div></div></div></div></section></div>";
		}
	}

}

add_action( 'remax_store_breadcrumb', 'remax_store_breadcrumb_section' );





/**
 * Remax_Store Pagination
 */
if ( ! function_exists( 'remax_store_number_pagination' ) ) {

	/**
	 * Remax_Store Pagination
	 *
	 * @since 1.0.0
	 * @return void            
	 */
	function remax_store_number_pagination() {
		global $numpages;
		$enabled = apply_filters( 'remax_store_pagination_enabled', true );

		if ( isset( $numpages ) && $enabled ) {
			ob_start();
			echo "<div class='cnotes-pagination'>";
			the_posts_pagination(
				array(
					'prev_text'    => esc_html__('<', 'remax-store'),
					'next_text'    => esc_html__('>', 'remax-store'),
					'taxonomy'     => 'category',
					'in_same_term' => true,
				)
			);
			echo '</div>';
			$output = ob_get_clean();
			echo apply_filters( 'remax_store_pagination_markup', $output ); // WPCS: XSS OK.
		}
	}
}

add_action( 'remax_store_pagination', 'remax_store_number_pagination' );



/*************************************Sidebar****************************** */


/**
 * Woocommerce Activation
 *
 * @return true
 * @since 1.0.0
 */
if ( ! function_exists( 'remax_store_is_woocommerce_activated' ) ) {
	function remax_store_is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}



/** 
 * Get Post Category
 * */
if( ! function_exists( 'remax_store_get_post_categories' ) ) {
	/**
	 * Get Post Category
	 *
	 * @return array
	 * @since 1.0.0
	 */
	function remax_store_get_post_categories( ){
		
		
		$all_categories = get_categories( );
		
		//default value
		$categories['all'] = 'all';  
		
		foreach( $all_categories as $category ){
			$categories[$category->term_id] = $category->name;    
		}
		
		return $categories;
	}

}


/**
 * Remax_Store before the main content
 * 
 * @since 1.0.0
 * @param int $post_id get the post id 
 * 
 * @return string
 */
if ( ! function_exists( 'remax_store_before_main_wrapper_main_sec' ) ) {

	/**
	 * Remax_Store Sidebar layout
	 *
	 * @since 1.0.0
	 * @return void            
	 */
	function remax_store_before_main_wrapper_main_sec() {
		
		echo '<div class="th-main-container-wrapper clearfix"><div class="container">';
		
	}
}

add_action( 'remax_store_before_mainsec', 'remax_store_before_main_wrapper_main_sec' );


/**
 * Remax_Store before the main content
 * 
 * @since 1.0.0
 * @param int $post_id get the post id 
 * 
 * @return string
 */
if ( ! function_exists( 'remax_store_before_main_wrapper_sec' ) ) {

	/**
	 * Remax_Store Sidebar layout
	 *
	 * @since 1.0.0
	 * @return void            
	 */
	function remax_store_before_main_wrapper_sec() {
		
		echo '</div></div>';
		
	}
}

add_action( 'remax_store_after_mainsec', 'remax_store_before_main_wrapper_sec' );


/******************************** Homepage ************************** */

/**
 * Remax_Store Homepage Slider Section
 */
if( ! function_exists( 'remax_store_homepage_slider_sec' ) ) {
	
	/**
	 * Remax_Store Homepage Slider Section
	 * 
	 * @since 1.0.0
	 * @return catid
	*/
	function remax_store_homepage_slider_sec(){

		/**
		 * Get all customizer data
		 * 
		 * @param array $homepage_slider_data default slider data.
		 * @param array $homepage_slider_section get the data from customizer section.
		 */
		$hoomepage_slider_catid = get_theme_mod( 'remax_store_slider_category_id' );
		$homepage_number_of_post = get_theme_mod( 'remax_store_slider_number_of_post',2 );
		
		
		$remax_store_blog_args = array( 'post_type'=>'post','posts_per_page'=>$homepage_number_of_post,'cat'=>$hoomepage_slider_catid );
		$remax_store_blog_query = new WP_Query( $remax_store_blog_args ); 
		?>
			<section id="remax-store-homepage-slider-section" class="th-homepage-slider">
				
				<!-- Start Slider Columns -->
                <div class="th-homepage-slider-wrapper">
					<div class="owl-carousel th-homepage-main-slider">
							<?php 
								while( $remax_store_blog_query->have_posts()){ $remax_store_blog_query->the_post(); 
									
							?>
                            
								
								<!-- Item Loop Start  -->
									<div class="item">
										<div class="th-banner-img">
											<?php 
												//slider images
												$slider_image = REMAX_STORE_THEME_IMG.'countdown.png'; 
												if( has_post_thumbnail() ){
													the_post_thumbnail(); 
												}else{
													echo '<img src="'.esc_url( $slider_image ).'">';
												}
											?>
										</div>
										<div class="th-description">
											<?php the_excerpt(); ?>
											<h1><?php the_title(); ?></h1>
											<a href="<?php the_permalink(); ?>" class="th-btn"><?php echo esc_html( 'Shop Now','remax-store' ); ?></a> 
										</div>
									</div>
								<!-- End Items Loop -->

						<?php }wp_reset_postdata(); ?>
					
					</div>
                </div><!-- End Slider Section -->
			
			</section>

		<?php
		
	}
}


add_action( 'remax_store_homepage_slider_section', 'remax_store_homepage_slider_sec' );




/**
 * Remax_Store Homepage Products Category Section
 */
if( ! function_exists( 'remax_store_homepage_products_category_sec' ) ) {
	
	/**
	 * Remax_Store Homepage Products Category Section
	 * 
	 * @since 1.0.0
	 * @return catid
	*/
	function remax_store_homepage_products_category_sec(){
		if(!remax_store_is_woocommerce_activated()): return; endif;

		/**
		 * Get all customizer data
		 * 
		 * @param array $remax_store_products_categorys_id array of category id
		 */
		$remax_store_products_categorys_id = get_theme_mod( 'remax_store_products_categorys_id',array(remax_store_get_default_products_categories()));
		
		?>
		<section id="remax_store_homepage_category" class="th-categories">
            <div class="container">
                <div class="row">
					<?php
						/**
						 * foreach loop for the all category display					
						 * @param int $remax_store_homepage_category_count count the category
						 * @param int $remax_store_numberofcat count the array category
						 * @since 1.0.0
						 */
						$remax_store_homepage_category_count = 1;
						$remax_store_numberofcat = count( $remax_store_products_categorys_id );

						foreach( $remax_store_products_categorys_id as $cat_key => $category_id ){ 
							/**
							 * Get all Term data from database by Term field and data.
							 * 
							 * @param int $category_id is woocommerce category id
							 * @since 1.0.0
							 * @return object
							 */
                            $term = get_term_by( 'id', $category_id, 'product_cat');


							/**
							 * Check the ter is null or not
							 * 							 * 
							 * @param int $category_id is woocommerce category id
							 * @since 1.0.0
							 */
                            if( $term == null ){
                                $category_id = remax_store_woo_cat_id_by_slug( 'uncategorized' );
                                
                                $term = get_term_by( 'id', $category_id, 'product_cat');
                                
                            }
                            
							/**
							 * Get the Category Images
							 * 							 
							 * @param int $remax_store_thumbnail_id wordpress media thumbnail id
							 * @param $remax_store_category_img_url get the woocommerce category images
							 * @since 1.0.0
							 */
                            $remax_store_thumbnail_id = get_term_meta( $category_id, 'thumbnail_id', true );
                            $remax_store_category_img_url = wp_get_attachment_url( $remax_store_thumbnail_id );

							/**
							 * set the default images
							 * 							 
							 * @param $remax_store_category_img_url get the woocommerce category images
							 * @since 1.0.0
							 */
							if( $remax_store_category_img_url == ''){
                                $remax_store_category_img_url = esc_url( get_template_directory_uri() . '/assets/images/countdown.png' );
							} 


							/**
							 * Display the html
							 */
							if( $remax_store_homepage_category_count == 1  ){
								echo '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12"><div class="row">';
							}

							/**
							 * category loop class hear
							 * 							 
							 * @param int $remax_store_cat_class category count
							 * @since 1.0.0
							 */
							$remax_store_class_hear ='';
							if( $remax_store_homepage_category_count == 1 || $remax_store_homepage_category_count == 2 ){
								$remax_store_cat_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
							}elseif( $remax_store_homepage_category_count == 3 ){
								$remax_store_cat_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
							}else{
								$remax_store_cat_class = '';
								$remax_store_class_hear ='th-big-add';
							}

							/**
							 * Category Print value
							 */
							echo '<div class="'.esc_attr( $remax_store_cat_class ).'">
									<div class="th-category '.esc_attr( $remax_store_class_hear ).'">
										<a href="'.esc_url( get_category_link( $category_id )).'">
											<figure>
												<img src="'.esc_url( $remax_store_category_img_url ).'" alt="'.esc_attr( $term->name ).'">
												<figcaption>
													<h3 class="th-title">'.esc_html( $term->name ).'</h3>
													<h5 class="th-cat-count">'.esc_html( $term->count ).esc_html__(' items','remax-store').'</h5>
												</figcaption>
											</figure>
										</a>
									</div>
								</div>';

							if( $remax_store_homepage_category_count == 3  ){
								echo '</div></div><div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">';
							}

							if(  $remax_store_homepage_category_count == $remax_store_numberofcat || $remax_store_homepage_category_count == 4  ){
								echo "</div>";
							}

							/**
							 * value increment 
							 * 							 
							 * @param int $remax_store_homepage_category_count wordpress media thumbnail id
							 * @since 1.0.0
							 */
							$remax_store_homepage_category_count++;
							if( $remax_store_homepage_category_count == 5 ){
								$remax_store_homepage_category_count = 1;
							}
						}
					?>
					
                </div><!-- end row -->
            </div><!-- End Container Class -->
        </section><!-- End Products Category section --> 

		<?php
		
	}
}


add_action( 'remax_store_homepage_category_section', 'remax_store_homepage_products_category_sec' );




/**
 * Remax_Store Homepage Hotoffer Section
 */
if( ! function_exists( 'remax_store_homepage_hotoffer_sec' ) ) {
	
	/**
	 * Remax_Store Homepage Hotoffer Section
	 * 
	 * @since 1.0.0
	 * @return catid
	*/
	function remax_store_homepage_hotoffer_sec(){
		if(!remax_store_is_woocommerce_activated()): return; endif;

		/**
		 * Get all customizer data
		 * 
		 * @param array $remax_store_hotoffer_title hotoffer title
		 * @param array $remax_store_hotoffer_cat_id hotoffer category id
		 * @param array $remax_store_hotoffer_number_of_post hotoffer number of products 
		 */
		$remax_store_hotoffer_cat_id = get_theme_mod( 'remax_store_hotoffer_cat_id');
		
		
			$remax_store_hotoffer_number_of_post = get_theme_mod( 'remax_store_hotoffer_number_of_post',2);
			
			//get backgorund images
			$remax_store_hotdeal_section_background_images = get_theme_mod( 'remax_store_hotdeal_section_background_images' );
			if(empty($remax_store_hotdeal_section_background_images)){
				$remax_store_hotdeal_section_background_images = REMAX_STORE_THEME_IMG.'countdown.png';
			}

			// Get $product object from product ID
			$product = wc_get_product( $remax_store_hotoffer_cat_id );
			$product_link = get_permalink( $remax_store_hotoffer_cat_id );
			
			if( !empty( $product ) ):
				//count down
				$sale_price_dates_to    = ( $date = get_post_meta( $remax_store_hotoffer_cat_id, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';
				$price_sale = get_post_meta( $remax_store_hotoffer_cat_id, '_sale_price', true );
				$date = date_create($sale_price_dates_to);
				$new_date = date_format($date,"M d,Y H:i");;

				
				?>
				<section id="remax_store_homepage_hotoffer_section" class="th-product-hotoffer" style="background:url(<?php echo esc_url($remax_store_hotdeal_section_background_images); ?>)">
					<div class="container">
						<div class="row">
							<div class="th-homepage-hotoffer-content">
								<h2 class="th-homepage-hotdeal"><?php echo esc_html( $product->get_name()); ?></h2>
								<div class="th-hotdeal-countdown-section" data-time="<?php echo esc_attr( $new_date ); ?>" id="hotoffer_countdown_sec"></div>
								<a href="<?php echo esc_url( $product_link ); ?>" class="th-btn th-homepage-hotdeal-buttom" ><?php echo esc_html__('Shop Now','remax-store'); ?></a>
							</div>
						</div>
					</div>
				</section>
				<?php
			endif;
	}
}


add_action( 'remax_store_homepage_hotoffer_section', 'remax_store_homepage_hotoffer_sec' );



/**
 * Remax_Store Homepage Products Tab Section
 */
if( ! function_exists( 'remax_store_homepage_products_tabs_sec' ) ) {
	
	/**
	 * Remax_Store Homepage Products Tab Section
	 * 
	 * @since 1.0.0
	 * @return catid
	*/
	function remax_store_homepage_products_tabs_sec(){
		if(!remax_store_is_woocommerce_activated()): return; endif;

		/**
		 * Get all customizer data
		 * 
		 * @param array $remax_store_products_tab_section multiple category
		 * @param array $remax_store_products_tab_number_of_products number of products display
		 */
		$remax_store_products_tab_section = get_theme_mod( 'remax_store_products_tabs_multiple_cat',array(remax_store_get_default_products_categories()));
		$remax_store_products_tab_number_of_products = get_theme_mod( 'remax_store_products_tab_number_of_products',8);
		
		?>
		<section id="remax_store_homepage_tabs_section" class="th-product th-products-ajax-wrapper">
            <div class="container">
                <div class="row">

					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="th-product-tab">
							<ul class="th-product-categories">
								<?php
									/**
									 * foreach loop for the all category display					
									 * @param int $category_count count the category
									 * @since 1.0.0
									 */
									$category_count = 1;
									if( !empty( $remax_store_products_tab_section )){
										foreach(  $remax_store_products_tab_section as $key => $remax_store_products_id ){ 
											
											/**
											 * Get all Term data from database by Term field and data.
											 * 
											 * @param int $remax_store_products_id is woocommerce category id
											 * @since 1.0.0
											 * @return object
											 */
											$term = get_term_by( 'id', $remax_store_products_id, 'product_cat');
									
											
											
											/**
											 * Check the ter is null or not
											 * 
											 * @param int $remax_store_products_id is woocommerce category id
											 * @since 1.0.0
											 */
											if( $term == null ){
												$remax_store_products_id = remax_store_woo_cat_id_by_slug('uncategorized');
												
												//set the default term
												$term = get_term_by( 'id', $remax_store_products_id, 'product_cat');
											}
									?>
									
									<li select_category_id = "<?php echo esc_attr( $remax_store_products_id ); ?>"  tab_product_count = "<?php echo esc_attr( $remax_store_products_tab_number_of_products ); ?>" class="ecommerce-shop-products-tabs-title tab-link  <?php if( $category_count == 1){ echo esc_attr('current'); }$category_count++; ?>"  data-tab="<?php echo esc_attr( $remax_store_products_id ); ?>"><a class="th-btn" href="#<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></a></li>
									
								<?php  }}  ?>
							</ul>
						</div>
					</div><!-- .columns -->

					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 remax-store-ajaxcall-products">
						<div id="remax_store_homepage_tabs_section" class="remax_store_homepage_tabs_section">
							<div class="product-tab ">
								<div class="row">
									<!-- Products Tab -->
									<?php
										/**
										 * Get woocommerce query 
										 * 
										 * @param array remax_store_products_tab_section array value 
										 * @param int $remax_store_products_tab_number_of_products number of products display
										 * @since 1.0.0
										 */
										$product_args = array(
											'post_type' => 'product',
											'tax_query' => array(
												array(
													'taxonomy'  => 'product_cat',
													'field'     => 'term_id', 
													'terms'     => reset( $remax_store_products_tab_section ) // First Element's Value                                                            
												),
												array(
													'taxonomy' => 'product_visibility',
													'field' => 'name',
													'terms' => 'exclude-from-catalog',
													'operator'	=>	'NOT IN'
												)
											),
											'posts_per_page' => $remax_store_products_tab_number_of_products
										);
										$query = new WP_Query( $product_args );

										if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
											echo '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 products-tab">';
											echo wc_get_template_part( 'content', 'product' );
											echo '</div>';
											} 
										}else{
											/**
											 * not have a products then dispaly images
											 * 
											 * @since 1.0.0
											 */
											for ($x = 1; $x <= 6; $x++) {
												echo '<div class="new col-lg-4 col-md-4 col-sm-6 col-xs-6">';
												remax_store_default_products();
												echo '</div>';
											}
										}
										wp_reset_postdata(); 
									?>
								</div>
							</div>
						</div>
					</div>



				</div>
			</div>
		</section>
		<?php

	}
}


add_action( 'remax_store_homepage_tabs_section', 'remax_store_homepage_products_tabs_sec' );



/**
 * Remax_Store Homepage Products Section
 */
if( ! function_exists( 'remax_store_homepage_single_products_sec' ) ) {
	
	/**
	 * Remax_Store Homepage Products Section
	 * 
	 * @since 1.0.0
	 * @return catid
	*/
	function remax_store_homepage_single_products_sec( $section_id = null ){
		if(!remax_store_is_woocommerce_activated()): return; endif;

		
		/**
		 * Homepage Section print
		 */
		$default = array(
				'section_title' 	=> 	'',
				'products_woocat' 	=>  '',
				'products_count'  	=> 	3,
			);
		$remax_store_homepage_products_tabs  = get_theme_mod('remax_store_homepage_products_tabs',$default);
		
		
		/**
		 * Get all customizer data
		 * 
		 * @param array $remax_store_products_section_cat_id single category id
		 * @param array $number_of_products number of products display
		 */
		
		if( array_key_exists($section_id,$remax_store_homepage_products_tabs) ):

			$remax_store_products_section_cat_id = $remax_store_homepage_products_tabs[$section_id]['products_woocat'];
			$number_of_products = $remax_store_homepage_products_tabs[$section_id]['products_count'];
			$remax_store_products_section_title = $remax_store_homepage_products_tabs[$section_id]['section_title'];
			$remax_store_category_link = get_category_link( $remax_store_products_section_cat_id );

			
			/**
			 * Get woocommerce query 
			 * 
			 * @param array $remax_store_products_section_cat_id single category id
			 * @param array $number_of_products number of products display
			 * @since 1.0.0
			 */
			$product_args = array(
				'post_type' => 'product',
				'tax_query' => array(
					array(
						'taxonomy'  => 'product_cat',
						'field'     => 'term_id', 
						'terms'     => intval( $remax_store_products_section_cat_id ) // First Element's Value                                                            
					),
					array(
						'taxonomy' => 'product_visibility',
						'field' => 'name',
						'terms' => 'exclude-from-catalog',
						'operator'	=>	'NOT IN'
					)
				),
				'posts_per_page' => intval( $number_of_products )
			);
			$query = new WP_Query( $product_args );

			?>
			<section id="remax_store_homepage_product_section" class="th-homepage-products-section">
				<div class="container">
					<?php if( !empty($remax_store_products_section_title) ): ?> 
					<div class="th-produts-header clearfix">
						<h2 class="th-produts-title"><?php echo esc_html($remax_store_products_section_title); ?></h2>
						<a href="<?php echo esc_url($remax_store_category_link); ?>"><?php echo esc_html__('View All','remax-store'); ?></a>
					</div>
					<?php endif; ?>
					
					<div class="row">
						<?php
							if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
								echo '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">';
								echo wc_get_template_part( 'content', 'product' );
								echo '</div>';
							}
						
						}else{
							/**
							 * not have a products then dispaly images
							 * 
							 * @since 1.0.0
							 */
							for ($x = 1; $x <= 3; $x++) {
								echo '<div class="new col-lg-4 col-md-4 col-sm-6 col-xs-6">';
								remax_store_default_products();
								echo '</div>';
							}
							
						}wp_reset_postdata();
						?>
					</div>
				</div>
			</section>
			<?php
		endif;
	}
}


add_action( 'remax_store_homepage_product_section', 'remax_store_homepage_single_products_sec' );




/**
 * Remax_Store Homepage Blog Section
 */
if( ! function_exists( 'remax_store_homepage_blog_sec' ) ) {
	
	/**
	 * Remax_Store Homepage Blog Section
	 * 
	 * @since 1.0.0
	 * @return catid
	*/
	function remax_store_homepage_blog_sec(){

		/**
		 * Get all customizer data
		 * 
		 * @param array $remax_store_blog_header_title blog header title
		 * @param array $remax_store_blog_category_id_select get the blog category
		 * @param array $remax_store_blog_number_of_post number of post
		 * @param array $remax_store_homepage_blog_section_sort post shor
		 */
		$remax_store_blog_header_title = get_theme_mod( 'remax_store_blog_header_title', esc_html__('LETEST NEWS', 'remax-store') );
		$remax_store_blog_category_id_select = get_theme_mod( 'remax_store_blog_category_id_select');
		$remax_store_blog_number_of_post = get_theme_mod( 'remax_store_blog_number_of_post',4);
		$remax_store_homepage_blog_section_sort = get_theme_mod( 'remax_store_homepage_blog_section_sort');
		$remax_store_category_link = get_category_link( $remax_store_blog_category_id_select );
		?>
		<section id="remax_store_homepage_blog_section" class="th-homepage-blog">
            <div class="container">
				<?php if( !empty( $remax_store_blog_header_title ) ): ?> 
				<div class="th-produts-header clearfix">
					<h2 class="th-produts-title"><?php echo esc_html( $remax_store_blog_header_title ); ?></h2>
					<a href="<?php echo esc_url( $remax_store_category_link ); ?>"><?php echo esc_html__('View All','remax-store'); ?></a>
				</div>
				<?php endif; ?>
				<div class="row">
					<div class="owl-carousel th-homepage-blog-slider">
						<?php
							/**
							 * Working on blog section hear.
							 * 
							 * @param array $remax_store_blog_args category arguments
							 */
							$remax_store_blog_args = array( 'post_type'=>'post','posts_per_page'=>$remax_store_blog_number_of_post,'cat'=>$remax_store_blog_category_id_select );
							$remax_store_blog_query = new WP_Query( $remax_store_blog_args ); 

							while( $remax_store_blog_query->have_posts()){ $remax_store_blog_query->the_post(); 

						?>
						<div class="item">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<article class="default_class">
									<?php
										/**
										 * Blog Content 
										 * 
										 * @param function remax_store_home_blog_thumbnail() | for the thumbnail 
										 * @param function remax_store_home_blog_category()  | for the category 
										 * @param function remax_store_home_blog_title()  	| for the title
										 * @param function remax_store_home_blog_meta()  	| for the meta
										 * @since 1.0.0
										 */
										foreach( get_theme_mod('remax_store_homepage_blog_section_sort',array('remax_store_home_blog_thumbnail','remax_store_home_blog_category','remax_store_home_blog_title','remax_store_home_blog_meta') ) as $remax_store_blog_item ){
											$blog_section = $remax_store_blog_item;
											$blog_section();
										}
									?>
								</article>
							</div>
						</div>
						<?php }wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
		</section>
		<?php
		
	}
}


add_action( 'remax_store_homepage_blog_section', 'remax_store_homepage_blog_sec' );


//post thumbnail section 
if( ! function_exists( 'remax_store_home_blog_thumbnail' ) ) {
	function remax_store_home_blog_thumbnail(){
		global $post;

		// Start thumbnail Conditions
		if( has_post_thumbnail() ):
			echo '<a href="'.esc_url(get_the_permalink()).'" class="post-thumbnail">';
				the_post_thumbnail();#Thumbnai Image display
			echo '</a>';
		endif;//End thumbnail Conditions
	}
}

//post category section 
if( ! function_exists( 'remax_store_home_blog_category' ) ) {
	function remax_store_home_blog_category(){
		global $post;

		// Start category Conditions
		echo '<div class="th-blog-category">';
		the_category();
		echo '</div>';
	}
}

//post title section 
if( ! function_exists( 'remax_store_home_blog_title' ) ) {
	function remax_store_home_blog_title(){
		global $post;

		// Start category Conditions
		echo '<header class="th-blog-header"><h4 class="th-blog-header-title"><a href="'.esc_url(get_the_permalink()).'">';
		the_title();
		echo '</a></h4></header>';

	}
}


//post meta section 
if( ! function_exists( 'remax_store_home_blog_meta' ) ) {
	function remax_store_home_blog_meta(){
		global $post;

		// Start meta Conditions
		echo '<div class="th-blog-meta">';
		remax_store_posted_on();
		remax_store_posted_by();
		echo '</div>';

	}
}

/**
 * Sidebar functions
 * 
 * @since 1.0.0
 * @return string
 */
if( ! function_exists( 'remax_store_page_layout' ) ) {
	function remax_store_page_layout(){
		/**
		 * get the value form customizer
		 * 
		 * @since 1.0.0
		 * @return string
		 */
		return  get_theme_mod( 'remax_store_post_sidebar_layout_settings','remax-store-right-sidebar' );

	}
}




/**
 * Remax_Store Customizer Default Value Options
 *
 * @return array()
 * @since 1.0.0
 */
function remax_store_customizer_section(){
	
	//Woocommerce Activate file
	if( remax_store_is_woocommerce_activated() ){
		$remax_store_woocommerce_section_array = array( 
											'remax_store_homepage_slider_section',  
											'remax_store_homepage_category_section', 
											'remax_store_homepage_hotoffer_section', 
											'remax_store_homepage_tabs_section', 
											'remax_store_homepage_blog_section',
										);
	}else{
		$remax_store_woocommerce_section_array = array( 'remax_store_homepage_slider_section', 'remax_store_homepage_blog_section');
	}

	
	return $remax_store_woocommerce_section_array;
}


/**
 * Remax Store Sort content activate options
 *
 * @param array $default_section
 * @return array
 * @since 1.0.0
 */
function remax_store_sort_content_activate(){
	
	/**
	 * Default section array
	 * @since 1.0.0
	 */
	$default_section =	array(
						'remax_store_homepage_slider_section'       	=> esc_html__( 'Slider', 'remax-store' ),
						'remax_store_homepage_category_section' 		=> esc_html__( 'Products Category', 'remax-store' ),
						'remax_store_homepage_hotoffer_section'			=> esc_html__( 'Hot Offer', 'remax-store' ),
						'remax_store_homepage_tabs_section'      		=> esc_html__( 'Products Tabs', 'remax-store' ),
						'remax_store_homepage_blog_section'        		=> esc_html__( 'Blog', 'remax-store' ), 
					);

	/**
	 * Dynamic call seciton
	 * @since 1.0.0
	 */
	$remax_store_homepage_products_tabs  = get_theme_mod('remax_store_homepage_products_tabs');
	if( !empty( $remax_store_homepage_products_tabs ) ):
		foreach( $remax_store_homepage_products_tabs as $key =>  $remax_store_section_add ){
			$default_section['remax_store_homepage_products_tabs-'.$key] = 'Products Section '.$key;
		}
	endif;


	/**
	 * Return
	 */
	return $default_section;
}

