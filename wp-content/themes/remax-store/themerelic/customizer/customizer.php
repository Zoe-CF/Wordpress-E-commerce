<?php
/**
 * Remax_Store Theme Customizer
 *
 * @package     Remax_Store
 * @author      Themerelic
 * @copyright   Copyright (c) 2018, Themerelic
 * @link        http:/themerelic.com
 * @since       Remax_Store 1.0.0
 * */

 /**
  * Customizer file section
  */
  class RemaxStoreCustomizer{

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
        
        /**
         * Remax_Store Customizer construct functins
         *
         * @access public
         */
        public function __construct(){

            

            /**
             * Remax_Store Customizer panel call
             *
             * @access public
             * @var    array
             * @since 1.0.0
             */
            //is woocommerce is not activate 
            if( !remax_store_is_woocommerce_activated() ){
                $remax_store_panels   = array( 'general','home','footer');

                 /**
                 * Remax_Store Customizer section array
                 *
                 * @access public
                 * @var    array
                 * @since 1.0.0
                 */
                $remax_store_sub_sections   = array( 
                    'general'    => array( 'basic','post-layout','breadcrumb','archive'),
                    'home'       => array('slider','blog'),
                    'footer'     => array( 'footer-general' ),
                );
            }else{
                $remax_store_panels   = array( 'general','home','footer','woocommerce');
            
                /**
                 * Remax_Store Customizer section array
                 *
                 * @access public
                 * @var    array
                 * @since 1.0.0
                 */
                $remax_store_sub_sections   = array( 
                    'general'    => array( 'basic','post-layout','breadcrumb','archive'),
                    'home'       => array('slider','product-categories','products-tabs','hot-offer','products-section','blog','sort'),
                    'footer'     => array( 'footer-general' ),
                    'woocommerce'=> array('archive','single'),
                );
            }

            
            //call the functions
            $this->remax_store_customizer_panel( $remax_store_panels , $remax_store_sub_sections );


            
            /**
             * Sanitize callback for checkbox
             * 
             * sanitization-functions.php | senitization the custoizer function
             * 
             * @since 1.0.0
            */
            load_template( REMAX_STORE_THEME_DIR . 'themerelic/customizer/sanitization-functions.php');
            
            
            /**
             * Customizer Preview Js
             * 
             * 
             * @since 1.0.0
            */
            add_action( 'customize_preview_init',array( $this,'remax_store_customize_preview_js' )  );
            add_action( 'customize_controls_enqueue_scripts',array( $this,'remax_store_customizer_scripts' ) );

        }


        /**
         * Remax_Store Customizer load the all panel and section
         *
         * @access public
         * @since 1.0.0
         */
        public function remax_store_customizer_panel( $remax_store_panels , $remax_store_sub_sections ){
            /**
             * Call the panel 
             * 
             * Register the all remax-store customizer panel
             * 
             * @since 1.0.0
             */
            foreach( $remax_store_panels as $panel ){
                load_template( REMAX_STORE_THEME_DIR . '/themerelic/customizer/panels/' . $panel . '.php');
            }

            
            /**
             * Call the section
             * 
             * Register the all remax-store customizer section,
             * and conrol.
             * 
             * @since 1.0.0
             */
            foreach( $remax_store_sub_sections as $k => $v ){
                foreach( $v as $w ){        
                    load_template( REMAX_STORE_THEME_DIR . 'themerelic/customizer/panels/' . $k . '/' . $w . '.php');
                }
            }
        }


        
        /**
         * Basic Js File enqueue Section
         * 
         * @access public 
         * @since 1.0.0
         */
        public function remax_store_customize_preview_js() {
            wp_enqueue_style( 'remax-store-customizer-preview', REMAX_STORE_THEME_URI . 'themerelic/customizer/css/customizer.css', array(), REMAX_STORE_THEME_VERSION );
            wp_enqueue_script( 'remax-store-customizer-preview', REMAX_STORE_THEME_URI . 'themerelic/customizer/js/customizer.js', array( 'customize-preview', 'customize-selective-refresh' ), REMAX_STORE_THEME_VERSION, true );
        }
    

        /**
         * Basic Js File enqueue Section
         * 
         * @access public
         * @since 1.0.0
         */
        public function remax_store_customizer_scripts() {
            wp_enqueue_style( 'remax-store-customize',REMAX_STORE_THEME_URI.'themerelic/customizer/css/customize.css', REMAX_STORE_THEME_VERSION, 'screen' );
            wp_enqueue_script( 'remax-store-customize', REMAX_STORE_THEME_URI . 'themerelic/customizer/js/customize-homepage.js', array( 'jquery' ), REMAX_STORE_THEME_VERSION, true );
        }
        
}

/**
 * customizer file this off by calling 'get_instance()' method
 */
RemaxStoreCustomizer::get_instance();