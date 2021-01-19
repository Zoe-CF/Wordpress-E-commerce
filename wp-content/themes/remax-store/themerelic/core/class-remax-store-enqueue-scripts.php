<?php
/**
 * Loader Functions
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
 * Theme Enqueue Scripts
 */
if ( ! class_exists( 'Remax_Store_Enqueue_Scripts' ) ) {

	/**
	 * Theme Enqueue Scripts
	 */
	class Remax_Store_Enqueue_Scripts {

        
		/**
		 * Constructor
		 */
		public function __construct() {

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 1 );

		}


		/**
		 * Enqueue Scripts
		 */
		public function enqueue_scripts() {

			/**
			 * Enqueue Google Fonts
			 * @since 1.0.0
			 */
			$remax_store_google_fonts_list = array('Montserrat','K2D');
			foreach(  $remax_store_google_fonts_list as $google_font ){
				wp_enqueue_style( 'remax-store-google-fonts-'.esc_html($google_font), '//fonts.googleapis.com/css?family='.esc_html($google_font).':200,300,400,500,600,700,800', false ); 
			}



            /**
             * Enqueue Style
			 * 
			 * Enqueue the all style file
			 * * @since 1.0.0
             */
			wp_enqueue_style( 'bootstrap', REMAX_STORE_THEME_URI . 'assets/library/bootstrap/css/bootstrap.css', array(), REMAX_STORE_THEME_VERSION, false );
			wp_enqueue_style( 'owl.carousel', REMAX_STORE_THEME_URI . 'assets/library/owl.carousel/css/owl.carousel.css', array(), REMAX_STORE_THEME_VERSION, false );
			wp_enqueue_style( 'font-awesome', REMAX_STORE_THEME_URI . 'assets/library/font-awesome/css/font-awesome.css', array(), REMAX_STORE_THEME_VERSION, false );
			wp_enqueue_style( 'remax-store-color', REMAX_STORE_THEME_URI . 'assets/css/color.css', array(), REMAX_STORE_THEME_VERSION, false );
			wp_enqueue_style( 'remax-store-style', get_stylesheet_uri() );
			wp_enqueue_style( 'remax-store-custom', REMAX_STORE_THEME_URI . 'assets/css/remax-store-custom.css', REMAX_STORE_THEME_VERSION, false );
			



            /**
             * Enqueue Script
             */
			wp_enqueue_script( 'bootstrap', REMAX_STORE_THEME_URI . 'assets/library/bootstrap/js/bootstrap.js', array(), REMAX_STORE_THEME_VERSION, true );
			wp_enqueue_script( 'matchHeight', REMAX_STORE_THEME_URI . 'assets/library/matchHeight/jquery.matchHeight-min.js', array(), REMAX_STORE_THEME_VERSION, true );
			wp_enqueue_script( 'owl.carousel', REMAX_STORE_THEME_URI . 'assets/library/owl.carousel/js/owl.carousel.js', array(), REMAX_STORE_THEME_VERSION, true );
			wp_enqueue_script( 'remax-store-custom', REMAX_STORE_THEME_URI . 'assets/js/remax-store-custom.js', array('jquery'), REMAX_STORE_THEME_VERSION, true );
            wp_enqueue_script( 'remax-store-navigation', REMAX_STORE_THEME_URI . 'assets/js/navigation.js', array(), REMAX_STORE_THEME_VERSION, true );
            wp_enqueue_script( 'remax-store-skip-link-focus-fix', REMAX_STORE_THEME_URI . 'assets/js/skip-link-focus-fix.js', array(), REMAX_STORE_THEME_VERSION, true );
			wp_enqueue_script( 'jquery-ui-core	', REMAX_STORE_THEME_URI . 'assets/library/jquery-ui/jquery-ui.min.js', array('jquery'), REMAX_STORE_THEME_VERSION, true );
            
			
			/** 
			 * Ajax enqueue script
			 */
			wp_register_script('remax-store-productstab-ajax', get_template_directory_uri() . '/assets/js/remax-store-ajax-products-tab.js', array(),REMAX_STORE_THEME_VERSION, true );
			$localize = array(
				'ajaxurl' => admin_url('admin-ajax.php'),
			);
			wp_localize_script('remax-store-productstab-ajax', 'REMAX_STOREAJAX', $localize);
			wp_enqueue_script('remax-store-productstab-ajax');

			/**
			 * comments replay js
			 */
            if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
			}
			
            
		}



	}

	new Remax_Store_Enqueue_Scripts();
}
