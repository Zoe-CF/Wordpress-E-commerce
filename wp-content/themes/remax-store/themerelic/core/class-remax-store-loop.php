<?php
/**
 * Remax_Store Loop
 *
 * @package     Remax_Store
 * @author      Themerelic
 * @copyright   Copyright (c) 2018, Themerelic
 * @link        http://themerelic.com
 * @since       Remax_Store 1.0.0
 * */


if ( ! class_exists( 'Remax_Store_Loop' ) ) :

	/**
	 * Remax_Store_Loop
	 *
	 * @since 1.0.0
	 */
	class Remax_Store_Loop {

		/**
		 * Instance
		 *
		 * @since 1.0.0
		 *
		 * @access private
		 * @var object Class object.
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 1.0.0
		 *
		 * @return object initialized object of class.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			// Loop.
			add_action( 'remax_store_content_loop', array( $this, 'loop_markup' ) );
			add_action( 'remax_store_content_page_loop', array( $this, 'loop_markup_page' ) );

			// Template Parts.
			add_action( 'remax_store_page_template_parts_content', array( $this, 'template_parts_page' ) );
			add_action( 'remax_store_page_template_parts_content', array( $this, 'template_parts_comments' ), 15 );
			add_action( 'remax_store_template_parts_content', array( $this, 'template_parts_post' ) );
			add_action( 'remax_store_template_parts_content', array( $this, 'template_parts_search' ) );
			add_action( 'remax_store_template_parts_content', array( $this, 'template_parts_default' ) );
			add_action( 'remax_store_template_parts_content', array( $this, 'template_parts_comments' ), 15 );

			// Template None.
			add_action( 'remax_store_template_parts_content_none', array( $this, 'template_parts_none' ) );
			add_action( 'remax_store_template_parts_content_none', array( $this, 'template_parts_404' ) );
			add_action( 'remax_store_404_content_template', array( $this, 'template_parts_404' ) );

			// Content top and bottom.
			add_action( 'remax_store_template_parts_content_top', array( $this, 'template_parts_content_top' ) );
			add_action( 'remax_store_template_parts_content_bottom', array( $this, 'template_parts_content_bottom' ) );

			// Add closing and ending div 'remax-store-row'.
			add_action( 'remax_store_template_parts_content_top', array( $this, 'remax_store_templat_part_wrap_open' ), 25 );
			add_action( 'remax_store_template_parts_content_bottom', array( $this, 'remax_store_templat_part_wrap_close' ), 5 );
		
		}

		/**
		 * Template part none
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function template_parts_none() {
			if ( is_archive() || is_search() ) {
				get_template_part( 'themerelic/template-parts/content', 'none' );
			}
		}

		/**
		 * Template part 404
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function template_parts_404() {
			if ( is_404() ) {
				get_template_part( 'themerelic/template-parts/content', '404' );
			}
		}

		/**
		 * Template part page
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function template_parts_page() {
			get_template_part( 'themerelic/template-parts/content', 'page' );
		}

		/**
		 * Template part single
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function template_parts_post() {
			if ( is_single() ) {
				get_template_part( 'themerelic/template-parts/content', 'single' );
			}
		}

		/**
		 * Template part search
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function template_parts_search() {
			if ( is_search() ) {
				get_template_part( 'themerelic/template-parts/content', 'search' );
			}
		}

		/**
		 * Template part comments
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function template_parts_comments() {
			if ( is_single() || is_page() ) {
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			}
		}

		/**
		 * Template part default
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function template_parts_default() {
			if ( ! is_page() && ! is_single() && ! is_search() && ! is_404() ) {
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'themerelic/template-parts/content', get_post_format() );
			}
		}

		/**
		 * Loop Markup for content page
		 *
		 * @since 1.0.0
		 */
		public function loop_markup_page() {
			$this->loop_markup( true );
		}

		/**
		 * Template part loop
		 *
		 * @param  boolean $is_page Loop outputs different content action for content page and default content.
		 *         if is_page is set to true - do_action( 'remax_store_page_template_parts_content' ); is added
		 *         if is_page is false - do_action( 'remax_store_template_parts_content' ); is added.
		 * @since 1.0.0
		 * @return void
		 */
		public function loop_markup( $is_page = false ) {
			?>
			<main id="main" class="site-main">

				<?php if ( have_posts() ) : ?>

					<?php do_action( 'remax_store_template_parts_content_top' ); ?>

					<?php
					while ( have_posts() ) :
						the_post();

						if ( true == $is_page ) {
							do_action( 'remax_store_page_template_parts_content' );
						} else {
							do_action( 'remax_store_template_parts_content' );
						}

						?>

					<?php endwhile; ?>

					<?php do_action( 'remax_store_template_parts_content_bottom' ); ?>

				<?php else : ?>

					<?php do_action( 'remax_store_template_parts_content_none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->
			<?php
		}

		/**
		 * Template part content top
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function template_parts_content_top() {
			if ( is_archive() ) {
				remax_store_content_while_before();
			}
		}

		/**
		 * Template part content bottom
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function template_parts_content_bottom() {
			if ( is_archive() ) {
				remax_store_content_while_after();
			}
		}

		/**
		 * Add wrapper div 'remax-store-row' for Remax_Store template part.
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function remax_store_templat_part_wrap_open() {
			if ( is_archive() || is_search() || is_home() ) {
				echo '<div class="remax-store-row">';
			}
		}

		/**
		 * Add closing wrapper div for 'remax-store-row' after Remax_Store template part.
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function remax_store_templat_part_wrap_close() {
			if ( is_archive() || is_search() || is_home() ) {
				echo '</div>';
			}
		}

	}

	/**
	 * Initialize class object with 'get_instance()' method
	 */
	Remax_Store_Loop::get_instance();

endif;
