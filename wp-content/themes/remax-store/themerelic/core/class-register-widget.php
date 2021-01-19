<?php
/**
 * Widget and sidebars related functions
 *
 * @package     Remax_Store
 * @author      Themerelic
 * @copyright   Copyright (c) 2018, Themerelic
 * @link        http://themerelic.com
 * @since       Remax_Store 1.0.0
 * */

/**
 * Register widget area.
 */
if ( ! function_exists( 'remax_store_widgets_init' ) ) :

	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
    */
	function remax_store_widgets_init() {

		
		/**
         * Register left sidebar widget area.
         *  @since 1.0.0
          */
        register_sidebar( array(
            'name'          => esc_html__( 'Right Sidebar', 'remax-store' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here.', 'remax-store' ),
            'before_widget' => '<section id="%1$s" class="widget widget-section %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );

        

        /**
         * Register Footer Sidebar
         * @since 1.0.0
         */
        register_sidebar( array(
            'name'          => esc_html__( 'Footer First', 'remax-store' ),
            'id'            => 'footer-1',
            'description'   => esc_html__( 'Add widgets here.', 'remax-store' ),
            'before_widget' => '<section id="%1$s" class="widget widget-section %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );


        
        /**
         * Register Footer Second widget
         * @since 1.0.0
         */
        register_sidebar( array(
            'name'          => esc_html__( 'Footer Second', 'remax-store' ),
            'id'            => 'footer-2',
            'description'   => esc_html__( 'Add widgets here.', 'remax-store' ),
            'before_widget' => '<section id="%1$s" class="widget widget-section %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );

        
        /**
         * Register Footer Third widget
         * @since 1.0.0
         */
        register_sidebar( array(
            'name'          => esc_html__( 'Footer Third', 'remax-store' ),
            'id'            => 'footer-3',
            'description'   => esc_html__( 'Add widgets here.', 'remax-store' ),
            'before_widget' => '<section id="%1$s" class="widget widget-section %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
		
	}
	add_action( 'widgets_init', 'remax_store_widgets_init' );

endif;
