<?php
/**
 * Remax_Store functions and definitions.
 * Text Domain: remax-store
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * Remax_Store is a very powerful theme and virtually anything can be customized
 * via a child theme.
 *
 * @package     Remax_Store
 * @author      Themerelic
 * @copyright   Copyright (c) 2018, Themerelic
 * @link        http://themerelic.com
 * @since       Remax_Store 1.0.0
 * */


/**
 * Remax_Store_After_Setup_Theme initial setup
 *
 * @since 1.0.0
 */
if ( ! class_exists( 'Remax_Store_After_Setup_Theme' ) ) {

	/**
	 * Remax_Store_After_Setup_Theme initial setup
	 */
	class Remax_Store_After_Setup_Theme {

		/**
		 * Instance
		 *
		 * @var $instance
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

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'after_setup_theme', array( $this, 'setup_theme' ), 2 );
            add_filter( 'excerpt_length',array($this,'remax_store_excerpt_length') , 999 );
            add_filter( 'nav_menu_submenu_css_class',array($this,'remax_store_nav_menu_submenu_css_class') );
            add_action( 'admin_init',array($this,'remax_store_add_editor_styles')  );
            add_action( 'after_setup_theme',array($this,'remax_store_content_width') , 0 );
        }

		/**
		 * Setup theme
		 *
		 * @since 1.0.0
		 */
		function setup_theme() {



			/*
            * Make theme available for translation.
            * Translations can be filed in the /languages/ directory.
            * If you're building a theme based on remax-store, use a find and replace
            * to change 'remax-store' to the name of your theme in all the template files.
            */
            load_theme_textdomain( 'remax-store', get_template_directory() . '/languages' );



            // Add default posts and comments RSS feed links to head.
            add_theme_support( 'automatic-feed-links' );



            /*
            * Let WordPress manage the document title.
            * By adding theme support, we declare that this theme does not use a
            * hard-coded <title> tag in the document head, and expect WordPress to
            * provide it for us.
            */
            add_theme_support( 'title-tag' );



            /*
            * Enable support for Post Thumbnails on posts and pages.
            *
            * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
            */
            add_theme_support( 'post-thumbnails' );


            /**
             * This theme uses wp_nav_menu() in one location.
             */
            register_nav_menus( array(
                'menu-1' => esc_html__( 'Primary', 'remax-store' ),
            ) );


            /*
            * Switch default core markup for search form, comment form, and comments
            * to output valid HTML5.
            */
            add_theme_support( 'html5', array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ) );

            

            /**
             * Add theme support for selective refresh for widgets.
             */
            add_theme_support( 'customize-selective-refresh-widgets' );


            /**
             * Add support for core custom logo.
             */
            add_theme_support( 'custom-logo', array(
                'height'      => 250,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
            ) );

            
            /**
             * Post formats.
             */
			add_theme_support(
				'post-formats',
				array(
					'gallery',
					'image',
					'link',
					'quote',
					'video',
					'audio',
					'status',
					'aside',
				)
            );

            //Set a default header image 980px width and 60px height:
            $args = array(
                'width'         => 250,
                'height'        => 600,
            );
            add_theme_support( 'custom-header', $args );
            


            /**
             * WooCommerce
             */
			add_theme_support( 'woocommerce' );
        }


        /**
         * Limite the excerpt
         * 
         * @since 1.0.4
         */
        function remax_store_excerpt_length( $length ) {
            $remax_store_excerpt_length = get_theme_mod('remax_store_the_excerpt_word_limit',20);

            if(is_admin()){
                return $length;
            }

            return intval( $remax_store_excerpt_length );
        }


        /**
         * Remax_Store submenu css class sub menu item add
         *
         * @param string $class file
         * @return void
         */
        function remax_store_nav_menu_submenu_css_class( $classes ) {
            $classes[] = 'remax-store-sidenav-dropdown';
            return $classes;
        }

        /**
		 * Registers an editor stylesheet for the theme.
         * 
         * @since 1.0.0
		 */
		function remax_store_add_editor_styles() {
			add_editor_style( 'remax-store-custom' );
        }


        /**
         * Set the content width in pixels, based on the theme's design and stylesheet.
         *
         * Priority 0 to make it available to lower priority callbacks.
         *
         * @global int $content_width
         */
        function remax_store_content_width() {
            // This variable is intended to be overruled from themes.
            // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
            // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
            $GLOBALS['content_width'] = apply_filters( 'remax_store_content_width', 640 );
        }
         

        
    }


    

}

/**
 * cicking this off by calling 'get_instance()' method
 */
Remax_Store_After_Setup_Theme::get_instance();