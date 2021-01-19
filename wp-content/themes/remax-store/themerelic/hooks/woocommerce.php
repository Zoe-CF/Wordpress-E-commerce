<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package     Remax_Store
 * @author      Themerelic
 * @copyright   Copyright (c) 2018, Themerelic
 * @link        http://themerelic.com
 * @since       Remax_Store 1.0.0
 * */


/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Remove default WooCommerce wrapper.
 * @since 1.0.0
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );


/**
 * Remove the products items,
 * Woocommerce Products Item 
 * 
 * @since 1.0.0
 */
/** */
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

/**
 * Breadcrumb section
 * @since 1.0.0
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
add_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 9, 0 );


/**
 * Remove Single Page
 * 
 * @param object $remax_store_woo 	| 	create the object on woocommerce
 * @since 1.0.0
 */
$remax_store_woo = new Remax_Store_Woocommerce();


/**
 * Enable/disable the woocommerce button
 * 
 * @since 1.0.0
 */
if( get_theme_mod('remax_store_social_share_enable',true) ){
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
	add_action( 'woocommerce_single_product_summary',array( $remax_store_woo,'remax_store_woo_social_share'), 50 );
}

/**
 * column wrapper
 */
add_action( 'woocommerce_before_shop_loop',array($remax_store_woo,'remax_store_woocommerce_product_columns_wrapper') , 40 );
add_action( 'woocommerce_after_shop_loop',array($remax_store_woo,'remax_store_woocommerce_product_columns_wrapper_close') , 40 );
		

/**
 * Woocommerce loop item
 */
add_action( 'woocommerce_before_shop_loop_item',array( $remax_store_woo,'remax_store_woocommerce_before_shop_loop_item'), 10 );


/***
 * create the class for woocommerce all woocommerce ,
 * action and filter
 * 
 * @since 1.0.0
 */
class Remax_Store_Woocommerce{

	/**
	 * Instance
	 *
	 * @var $instance
	 * @since 1.0.0
	 */
	private static $instance;

	/**
	 * Initiator
	 *
	 * @since 1.0.0
	 * @return object
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	
	public function __construct(){
		
		/**
		 * Woocommerce Action
		 *
		 * @return void
		 * @since 1.0.0
		 */
		add_action( 'after_setup_theme',array($this,'remax_store_woocommerce_setup')  );
		add_action( 'wp_enqueue_scripts',array($this,'remax_store_woocommerce_scripts') );
		add_action( 'woocommerce_before_main_content',array($this,'remax_store_woocommerce_wrapper_before') );
		add_action( 'woocommerce_after_main_content',array($this, 'remax_store_woocommerce_wrapper_after') );
		add_action( 'yith_wcqv_product_image',array($this,'remax_store_yith_product_image_wrap_open') , 9 );
		add_action( 'yith_wcqv_product_image',array($this,'remax_store_yith_product_image_wrap_close') , 21 );

		add_action( "wp_ajax_nopriv_remax_store_products_ajax",array($this,'remax_store_products_ajax')  );
		add_action( 'wp_ajax_remax_store_products_ajax',array($this,'remax_store_products_ajax')  );


		/**
		 * Woocommerce Filter
		 *
		 * @return void
		 * @since 1.0.0
		 */
		add_filter( 'body_class',array($this,'remax_store_woocommerce_active_body_class') );
		add_filter( 'loop_shop_per_page',array($this, 'remax_store_woocommerce_products_per_page') );
		add_filter( 'woocommerce_product_thumbnails_columns',array($this,'remax_store_woocommerce_thumbnail_columns')  );
		add_filter( 'loop_shop_columns',array($this, 'remax_store_woocommerce_loop_columns' ));
		add_filter( 'woocommerce_output_related_products_args',array($this,'remax_store_woocommerce_related_products_args') );
		add_filter( 'woocommerce_add_to_cart_fragments',array($this,'remax_store_woocommerce_cart_link_fragment')  );
		add_filter( 'woocommerce_breadcrumb_defaults',array( $this,'remax_store_woocommerce_breadcrumbs' )  );
				
			
	}


	
	/**
	 * Remax Store Quick View Wrapper
	 * 
	 * @access public
	 * @since 1.0.0 
	 */
	function remax_store_yith_product_image_wrap_open () {
		echo '<div class="remax-store-product-image-wrapper">';
	}

	/**
	 * Remax Store quick view wrapper end
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	function remax_store_yith_product_image_wrap_close () {
		echo '</div>';
	}


	/**
	 * WooCommerce setup function.
	 *
	 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
	 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	function remax_store_woocommerce_setup() {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}



	/**
	 * WooCommerce specific scripts & stylesheets.
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	function remax_store_woocommerce_scripts() {
		wp_enqueue_style( 'remax-store-woocommerce-style', REMAX_STORE_THEME_URI . 'woocommerce.css' );

		$font_path   = WC()->plugin_url() . '/assets/fonts/';
		$inline_font = '@font-face {
				font-family: "star";
				src: url("' . $font_path . 'star.eot");
				src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
					url("' . $font_path . 'star.woff") format("woff"),
					url("' . $font_path . 'star.ttf") format("truetype"),
					url("' . $font_path . 'star.svg#star") format("svg");
				font-weight: normal;
				font-style: normal;
			}';

		wp_add_inline_style( 'remax-store-woocommerce-style', $inline_font );
	}



	/**
	 * Add 'woocommerce-active' class to the body tag.
	 *
	 * @access public
	 * @param  array $classes CSS classes applied to the body tag.
	 * @return array $classes modified to include 'woocommerce-active' class.
	 * @since 1.0.0
	 */
	function remax_store_woocommerce_active_body_class( $classes ) {
		$classes[] = 'woocommerce-active';

		return $classes;
	}
	


	/**
	 * Products per page.
	 *
	 * @access public
	 * @return integer number of products.
	 * @since 1.0.0
	 */
	function remax_store_woocommerce_products_per_page() {
		$remax_store_woocommerce_products_per_page = get_theme_mod('remax_store_woocommerce_products_per_page',12);
		return $remax_store_woocommerce_products_per_page;
	}
	


	/**
	 * Product gallery thumnbail columns.
	 *
	 * @access public
	 * @return integer number of columns.
	 * @since 1.0.0
	 */
	function remax_store_woocommerce_thumbnail_columns() {
		return 4;
	}



	/**
	 * Default loop columns on product archives.
	 *
	 * @access public
	 * @return integer products per row.
	 * @since 1.0.0
	 */
	function remax_store_woocommerce_loop_columns() {
		$remax_store_woocommerce_products_per_page = get_theme_mod('remax_store_woocommerce_loop_columns',3);
		return $remax_store_woocommerce_products_per_page;
	}
	


	/**
	 * Related Products Args.
	 *
	 * @access public
	 * @param array $args related products args.
	 * @return array $args related products args.
	 * @since 1.0.0
	 */
	function remax_store_woocommerce_related_products_args( $args ) {
		$relate_products_count = get_theme_mod('remax_store_woocommerce_related_products_posts_per_page',3);
		$relate_products_column = get_theme_mod('remax_store_woocommerce_related_products_columns',3);

		$defaults = array(
			'posts_per_page' => $relate_products_count,
			'columns'        => $relate_products_column,
		);

		$args = wp_parse_args( $defaults, $args );

		return $args;
	}



	/**
	 * Product columns wrapper.
	 *
	 * @access public
	 * @return  void
	 * @since 1.0.0
	 */
	function remax_store_woocommerce_product_columns_wrapper() {
		$columns = $this->remax_store_woocommerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
	
	/**
	 * Product columns wrapper close.
	 *
	 * @access public
	 * @return  void
	 * @since 1.0.0
	 */
	function remax_store_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}



	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	function remax_store_woocommerce_wrapper_before() {
		?>
		<?php remax_store_before_mainsec(); ?>
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
			<?php
	}



	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	function remax_store_woocommerce_wrapper_after() {
			?>
				</main><!-- #main -->
			</div><!-- #primary -->
		<?php remax_store_after_mainsec(); ?>
		<?php
	}


	
	/**
	 * Display Header Cart.
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	function remax_store_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<div id="site-header-cart" class="th-header-cart-section site-header-cart">
			<div class="<?php echo esc_attr( $class ); ?>">
				<?php $this->remax_store_woocommerce_cart_link(); ?>
			</div>
			<div class="th-header-cart-section">
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</div>
		</div>
		<?php
	}



	
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 * @access public
	 * @since 1.0.0
	 */
	function remax_store_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		$this->remax_store_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
	
	
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	function remax_store_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'remax-store' ); ?>">
			
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><i class="fa fa-shopping-bag" aria-hidden="true"></i> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}


	/**
	 * Remax_Store Social Share
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	function remax_store_woo_social_share() {
			/**
			 * Remax_Store woo social share
			 */
			$single_page_id = get_the_ID();
			$single_page_url = get_the_permalink( $single_page_id );
			$single_page_title = get_the_title( $single_page_id );
			$single_page_desc = get_the_excerpt( $single_page_id );
		?>
		<div class="th-social-share th-social clearfix ">
			<span><?php echo esc_html__('Share This :','remax-store'); ?></span>
			<ul>
				<li class="facebook">
					<!-- Email -->
					<a href="mailto:?Subject=<?php echo esc_attr( $single_page_title ); ?>&amp;Body=<?php echo esc_attr( $single_page_desc ); ?> <?php echo esc_url( $single_page_url ); ?>">
						<i class="fa fa-envelope"></i>
					</a>
				</li>
				<li class="facebook"><!-- Facebook -->
					<a href="<?php echo esc_url('http://www.facebook.com/sharer.php?u='.$single_page_url); ?>" target="_blank">
						<i class="fa fa-facebook-f"></i>
					</a>
				</li>
					
				<li class="twitter"><!-- Twitter -->
					<a href="<?php echo esc_url('https://twitter.com/share?url='.$single_page_url); ?>&amp;text=<?php echo esc_attr($single_page_title); ?>&amp;hashtags=simplesharebuttons" target="_blank">
						<i class="fa fa-twitter"></i>
					</a>
				</li>

				<li class="google-plus"><!-- Google+ -->
					<a href="<?php echo esc_url('https://plus.google.com/share?url='.$single_page_url); ?>" target="_blank">
						<i class="fa fa-google-plus" aria-hidden="true"></i>
					</a>
				</li>
			</ul>  
		</div>
		<?php 
	}


	/**
	 * Remax_Store Sale Percentage Loop
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	function remax_store_sale_percentage_loop( $percentage=true ) {
		global $product;
		
		if ( $product->is_on_sale() ) {
			
			if ( ! $product->is_type( 'variable' ) and $product->get_regular_price() and $product->get_sale_price() ) {
				$max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;
			} else {
				$max_percentage = 0;
				
				foreach ( $product->get_children() as $child_id ) {
					$variation = wc_get_product( $child_id );
					$price = $variation->get_regular_price();
					$sale = $variation->get_sale_price();
					$percentage = '';
					if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;
						if ( $percentage > $max_percentage ) {
							$max_percentage = $percentage;
						}
				}
			
			}

			/**
			 * Return the woocommerce percentage
			 */
			echo "<div class='th-woocommerce-percentage'><span>-" . esc_html( round($max_percentage) ) . "%</span></div>";
			
		}

	}


	/**
	 * Woocommerce Wishlist Section
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	function remax_store_woocommerce_top_wishlist() {
		if (!defined( 'YITH_WCWL' )) return;
		?>
		<div class="th-wishlist-section">
			<a href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url()); ?>" class="th-wishlist-items">
				<i class="fa fa-heart" aria-hidden="true"></i>
				<span class="wishlist-count">
					<?php 
						$wishlist_count = YITH_WCWL()->count_products();
						echo esc_html( $wishlist_count ); 
					?>
				</span>
			</a>
		</div>
		<?php 
	}


	/**
	 * Woocommerce Woocommerce Products Rating
	 * 
	 * @access public
	 * @return array
	 * @since 1.0.0
	 */
	public function remax_store_woo_get_star_rating(){
	    global $woocommerce, $product;
	    $average = $product->get_average_rating();
		?>
		<div class="rating" itemscope itemtype="http://schema.org/AggregateRating">
			<?php
				/**
				 * Rating loop section
				 * 
				 * @since 1.0.0
				 */
				for( $i = 1; $i<=5; $i++ ) {
					if ($i<=$average){
						echo '<i class="fa fa-star gold"></i>';
					}
					else{ 
						echo '<i class="fa fa-star black"></i>';
					} 
				} 
			?>
		</div>
		<?php
	}


	/**
	 * Woocommerce Quick View
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function remax_store_woo_product_quickview(){
		if ( !defined( 'YITH_WCQV' )) return;

        global $product;
        $quick_view = YITH_WCQV_Frontend();
        remove_action( 'woocommerce_after_shop_loop_item', array( $quick_view, '_add_quick_view_button' ), 15 );
		echo '
			<a title="'. esc_attr( 'Quick View', 'remax-store' ) .'" href="#" class="yith-wcqv-button" data-product_id="' . esc_attr( get_the_ID() ) . '">
				<i class="fa fa-eye"></i>
			</a>	
			';

	}



	/**
	 * Remax Store Wishlist products
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function remax_store_wishlist_products() {
		if ( !defined( 'YITH_WCWL' )) return;
			global $product;
			$url			 = add_query_arg( 'add_to_wishlist', $product->get_id() );
			$id				 = $product->get_id();
			$wishlist_url	 = YITH_WCWL()->get_wishlist_url();
			?>  
			<div class="add-to-wishlist-custom add-to-wishlist-<?php echo esc_attr( $id ); ?>">

				<div class="yith-wcwl-add-button show" style="display:block">  
					<a href="<?php echo esc_url( $url ); ?>" rel="nofollow" data-product-id="<?php echo esc_attr( $id ); ?>" data-product-type="simple" class="add_to_wishlist">
						<i class="fa fa-heart"></i>
					</a>
				</div>

				<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"> 
					<a href="<?php echo esc_url( $wishlist_url ); ?>"><i class="fa fa-check" aria-hidden="true"></i></a>
				</div>

				<div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
					<span class="feedback"><?php echo esc_html__( 'The product is already in the wishlist!', 'remax-store' ); ?></span>
				</div>

				<div class="clear"></div>
				<div class="yith-wcwl-wishlistaddresponse"></div>

			</div>
		<?php
	}


	/**
	 * Remax Store compare products function
	 *
	 * @access public
	 * @param boolean $product_id get the products id
	 * @param array $args
	 * @return void
	 * @since 1.0.0
	 */
	function remax_store_add_compare_link( $product_id = false, $args = array() ) {
		if ( !defined( 'YITH_WOOCOMPARE' )) return;
		extract( $args );

		if ( ! $product_id ) {
			global $product;
			$productid = $product->get_id();
			$product_id = isset( $productid ) ? $productid : 0;
		}
		
		$is_button = ! isset( $button_or_link ) || ! $button_or_link ? get_option( 'yith_woocompare_is_button' ) : $button_or_link;

		if ( ! isset( $button_text ) || $button_text == 'default' ) {
			$button_text = get_option( 'yith_woocompare_button_text', esc_html__( 'Compare', 'remax-store' ) );
			yit_wpml_register_string( 'Plugins', 'plugin_yit_compare_button_text', $button_text );
			$button_text = yit_wpml_string_translate( 'Plugins', 'plugin_yit_compare_button_text', $button_text );
		}
		printf( '<div class="remax-store-compare"><a title="'. esc_attr__( 'Add to Compare', 'remax-store' ) .'" href="%s" class="%s" data-product_id="%d" rel="nofollow"><span><i class="fa fa-exchange"></i></span></a></div>', '#', 'compare', intval($product_id));
	}


	/**
	 * Remax_Store Woocommerce products templates
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	function remax_store_woocommerce_before_shop_loop_item(){
		?>
		<div class="th-products-wrapper">
				<div class="th-img-wrapper">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('woocommerce_thumbnail'); ?>
					</a>
					<div class="th-products-hover">
						<?php 
							woocommerce_template_loop_add_to_cart();
							$this->remax_store_add_compare_link();
							$this->remax_store_wishlist_products();
							$this->remax_store_woo_product_quickview(); 
						?>
				</div>
			</div>

			<div class="th-product-detail">
				<div class="th-product-rating">
					<?php $this->remax_store_woo_get_star_rating(); ?>
				</div>
				<div class="th-product-title">
					<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
				</div>
				<div class="th-product-price">
					<?php  woocommerce_template_loop_price();#Woocommerce Template loop Price ?>
				</div>
			</div>
		</div>
		<?php
	}


	/**
	 * Woocommerce Ajax call products section
	 * 
	 * @access public
	 * @since 1.0.0
	 */
	function remax_store_products_ajax(){
		/**
		 * woocommerce ajax products call section
		 * 
		 * @param int $remax_store_tab_category_id			| get the products category id
		 * @param int $remax_store_tab_product_count			| get the number of products count
		 * @since 1.0.0
		 */
		//category id
		$remax_store_tab_category_id = intval( $_POST['remax_store_products_id'] );
		if ( ! $remax_store_tab_category_id ) {
			$remax_store_tab_category_id = '';
		}

		//products count
		$remax_store_tab_product_count = intval( $_POST['remax_store_products_count'] );
		if ( ! $remax_store_tab_product_count ) {
		$remax_store_tab_product_count = '';
		}

        $html = ob_start();
		?>
		<!-- woocommerce remax-store products -->
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
										'terms'     => $remax_store_tab_category_id // get the products id                                                           
									),
									array(
										'taxonomy' => 'product_visibility',
										'field' => 'name',
										'terms' => esc_html__('exclude-from-catalog','remax-store'),
										'operator'	=>	'NOT IN'
									)
								),
								'posts_per_page' => $remax_store_tab_product_count
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
								for ($x = 1; $x <= 8; $x++) {
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
		<!-- end woocommerce store products -->
		<?php
		$html = ob_get_contents();
		ob_end_clean();
		echo wp_kses_post( $html );
    	exit;
	}


	/**
	 * Breadcrumb Default
	 * 
	 * @access public
	 * @since 1.0.0
	 */
	function remax_store_woocommerce_breadcrumbs() {
		return array(
				'delimiter'   => ' &#47; ',
				'wrap_before' => '<div class="remax-store-sticky-header" id="remax-store-sticky-header"><section class="breadcrumb"><div class="container"><div class="row"><div class="col-md-12"><div class="breadcrumb_wrap">',
				'wrap_after'  => '</div></div></div></div></section></div>',
				'before'      => '',
				'after'       => '',
				'home'        => _x( 'Home', 'breadcrumb', 'remax-store' ),
			);
	}


}

/**
 * Woocommerce this off by calling 'get_instance()' method
 */
Remax_Store_Woocommerce::get_instance();
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
